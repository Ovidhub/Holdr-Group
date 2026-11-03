<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Updating Profile Route
    public function updateprofile(Request $request)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        return response()->json(['status' => 200, 'success' => 'Profile Information Updated Sucessfully!']);
    }

    //update account and contact info
    public function updateacct(Request $request)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'bank_name' => $request['bank_name'],
                'account_name' => $request['account_name'],
                'account_number' => $request['account_no'],
                'swift_code' => $request['swiftcode'],
                'btc_address' => $request['btc_address'],
                'eth_address' => $request['eth_address'],
                'ltc_address' => $request['ltc_address'],
                'usdt_address' => $request['usdt_address'],
            ]);
        return response()->json(['status' => 200, 'success' => 'Withdrawal Info updated Sucessfully']);
    }

    //Update Password
    public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('message', 'Current password does not match!');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password updated successfully');
    }


    public function changepin(Request $request){

       
        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('message', 'Password does not match!');
        }
        User::where('id',Auth::user()->id)
        ->update([
            'pin' => $request->pin,
           
        ]);
   

        return back()->with('success', 'Transaction Pin Updated Successfully');
    }

    // Update email preference logic
    public function updateemail(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->sendotpemail = $request->otpsend;
        $user->sendroiemail = $request->roiemail;
        $user->sendinvplanemail = $request->invplanemail;
        $user->save();
        return response()->json(['status' => 200, 'success' => 'Email Preference updated']);
    }


    // update Profile photo
    public function updateprofilephoto(Request $request)
    {
        if (!$request->hasFile('photo') || !$request->file('photo')->isValid()) {
            return redirect()->back()
                ->with('message', 'Please select a valid image file (JPG, PNG, WEBP, or GIF up to 10MB).');
        }

        $this->validate($request, [
            'photo' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ]);

        $storedPhoto = User::storeProfilePhoto($request->file('photo'));
        if (!$storedPhoto) {
            return redirect()->back()
                ->with('message', 'Unaccepted profile image uploaded. Please use a JPG, PNG, WEBP, or GIF image.');
        }

        User::where('id', Auth::user()->id)->update([
            'profile_photo_path' => $storedPhoto,
        ]);

        return redirect()->back()
            ->with('success', 'Profile photo uploaded successfully.');
    }

    /**
     * Serve user profile photos with accurate MIME headers across cPanel, subfolder installs,
     * legacy filenames, and serverless runtime storage.
     */
    public function serveProfilePhoto($filename)
    {
        $safeName = basename(rawurldecode((string) $filename));
        if (
            $safeName === '' ||
            $safeName === '.' ||
            $safeName === '..' ||
            preg_match('/\.(php|phtml|phar|env|sql|sqlite|log|bak)$/i', $safeName)
        ) {
            return $this->fallbackAvatarResponse();
        }

        $candidateFiles = [
            storage_path('app/public/photos/' . $safeName),
            base_path('storage/app/public/photos/' . $safeName),
            public_path('storage/app/public/photos/' . $safeName),
            public_path('storage/photos/' . $safeName),
        ];

        foreach ($candidateFiles as $filePath) {
            if (is_file($filePath) && is_readable($filePath)) {
                $bytes = @file_get_contents($filePath);
                if ($bytes !== false && $bytes !== '') {
                    $mime = $this->detectSafeImageMime($bytes, $safeName);
                    if ($mime !== null) {
                        return response($bytes, 200, [
                            'Content-Type' => $mime,
                            'Cache-Control' => 'public, max-age=86400',
                        ]);
                    }
                }
            }
        }

        // Fallback: check compact base64 backup in `images` table
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('images')) {
                $record = \Illuminate\Support\Facades\DB::table('images')
                    ->where('ref_key', 'profile:' . $safeName)
                    ->orderByDesc('id')
                    ->first();
                if ($record && !empty($record->description)) {
                    $decoded = base64_decode($record->description, true);
                    if ($decoded !== false && $decoded !== '') {
                        $mime = $this->detectSafeImageMime($decoded, $safeName) ?: ($record->title ?: 'image/jpeg');
                        return response($decoded, 200, [
                            'Content-Type' => $mime,
                            'Cache-Control' => 'public, max-age=86400',
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            // Fall through to SVG avatar
        }

        return $this->fallbackAvatarResponse();
    }

    /**
     * Fallback static storage server for runtime-uploaded public assets (logos, KYC docs, deposit proofs)
     * when symlink is absent or running in a serverless container.
     */
    public function servePublicStorage($path)
    {
        $clean = ltrim(str_replace('\\', '/', rawurldecode((string) $path)), '/');
        if (
            $clean === '' ||
            strpos($clean, '..') !== false ||
            preg_match('/\.(php|phtml|phar|env|sql|sqlite|log|bak)$/i', $clean)
        ) {
            abort(404);
        }

        if (stripos($clean, 'photos/') === 0 && substr_count($clean, '/') === 1) {
            return $this->serveProfilePhoto(substr($clean, strlen('photos/')));
        }

        $roots = [
            storage_path('app/public'),
            base_path('storage/app/public'),
            public_path('storage/app/public'),
            public_path('storage'),
        ];

        foreach ($roots as $root) {
            $realRoot = @realpath($root);
            if (!$realRoot) {
                continue;
            }
            $candidate = @realpath($realRoot . '/' . $clean);
            if ($candidate && strpos($candidate, $realRoot) === 0 && is_file($candidate) && is_readable($candidate)) {
                $bytes = @file_get_contents($candidate);
                if ($bytes === false) {
                    continue;
                }
                $mime = $this->detectSafeImageMime($bytes, $candidate);
                if ($mime === null) {
                    $ext = strtolower(pathinfo($candidate, PATHINFO_EXTENSION));
                    if ($ext === 'pdf') {
                        $mime = 'application/pdf';
                    } elseif ($ext === 'ico') {
                        $mime = 'image/x-icon';
                    } else {
                        continue;
                    }
                }
                return response($bytes, 200, [
                    'Content-Type' => $mime,
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            }
        }

        abort(404);
    }

    protected function detectSafeImageMime(string $bytes, string $filename): ?string
    {
        $info = @getimagesizefromstring($bytes);
        if ($info && !empty($info['mime']) && stripos($info['mime'], 'image/') === 0) {
            return $info['mime'];
        }

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext === 'svg' && stripos($bytes, '<svg') !== false && stripos($bytes, '<?php') === false) {
            return 'image/svg+xml';
        }

        return null;
    }

    protected function fallbackAvatarResponse()
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128">'
            . '<rect width="128" height="128" rx="64" fill="#C41E3A"/>'
            . '<circle cx="64" cy="48" r="22" fill="#ffffff" fill-opacity="0.9"/>'
            . '<path d="M28 108c6-20 22-30 36-30s30 10 36 30" fill="#ffffff" fill-opacity="0.9"/>'
            . '</svg>';

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }
   // for front end content management
   function RandomStringGenerator($n) 
   { 
       $generated_string = ""; 
       $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
       $len = strlen($domain); 
       for ($i = 0; $i < $n; $i++) 
       { 
           $index = rand(0, $len - 1); 
           $generated_string = $generated_string . $domain[$index]; 
       } 
       // Return the random generated string 
       return $generated_string; 
   } 
}