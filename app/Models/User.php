<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Models\Settings;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
   
    /**
     * Send the email verification notification.
     *
     * @return void
     */

    public function sendEmailVerificationNotification()
    {
        $settings = Settings::where('id', 1)->first();

        if ($settings->enable_verification == 'true') {
            $this->notify(new VerifyEmail);
        }
        
    }
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function dp(){
    	return $this->hasMany(Deposit::class, 'user');
    }

    /**
     * Resolve the user's profile photo URL safely across any domain, protocol,
     * cPanel folder layout, or serverless environment (Vercel).
     */
    public function getProfilePhotoUrlAttribute()
    {
        $path = trim((string) ($this->profile_photo_path ?? ''));

        if ($path === '') {
            return $this->defaultProfilePhotoUrl();
        }

        if (
            stripos($path, 'data:image/') === 0 ||
            stripos($path, 'http://') === 0 ||
            stripos($path, 'https://') === 0
        ) {
            return $path;
        }

        $clean = ltrim(str_replace('\\', '/', $path), '/');
        $prefixes = [
            'storage/app/public/photos/',
            'app/public/photos/',
            'public/photos/',
            'storage/photos/',
            'photos/',
        ];
        foreach ($prefixes as $prefix) {
            if (stripos($clean, $prefix) === 0) {
                $clean = substr($clean, strlen($prefix));
                break;
            }
        }

        $filename = basename($clean);
        if ($filename === '' || $filename === '.' || $filename === '..') {
            return $this->defaultProfilePhotoUrl();
        }

        $baseUrl = '';
        try {
            if (function_exists('app') && app()->bound('request') && request()) {
                $baseUrl = rtrim((string) request()->getBaseUrl(), '/');
            }
        } catch (\Throwable $e) {
            $baseUrl = '';
        }

        try {
            if (\Illuminate\Support\Facades\Route::has('profile.photo')) {
                return $baseUrl . '/profile-photo/' . rawurlencode($filename);
            }
        } catch (\Throwable $e) {
            // Fallback below
        }

        return $baseUrl . '/storage/app/public/photos/' . rawurlencode($filename);
    }

    /**
     * Generate a self-contained SVG initials avatar as fallback when no photo is set
     * or if a referenced file was manually deleted.
     */
    public function defaultProfilePhotoUrl()
    {
        $first = trim((string) ($this->name ?? ''));
        $last = trim((string) ($this->lastname ?? ''));

        if ($last !== '') {
            $initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));
        } elseif ($first !== '') {
            $parts = preg_split('/\s+/', $first);
            if (count($parts) >= 2) {
                $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
            } else {
                $initials = strtoupper(substr($first, 0, 2));
            }
        } else {
            $initials = 'U';
        }

        $safeInitials = htmlspecialchars($initials ?: 'U', ENT_QUOTES, 'UTF-8');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128">'
            . '<defs><linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">'
            . '<stop offset="0%" stop-color="#C41E3A"/><stop offset="100%" stop-color="#881337"/>'
            . '</linearGradient></defs>'
            . '<rect width="128" height="128" rx="64" fill="url(#g)"/>'
            . '<text x="50%" y="50%" dy=".35em" text-anchor="middle" fill="#ffffff" '
            . 'font-family="Arial, sans-serif" font-size="48" font-weight="700">' . $safeInitials . '</text>'
            . '</svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Validate, normalize, and store an uploaded profile image so it works on both
     * standard/cPanel hosting (MySQL + filesystem) and serverless environments (Vercel).
     *
     * @param  \Illuminate\Http\UploadedFile|null  $file
     * @return string|null  Value to persist into `users.profile_photo_path`, or null if invalid
     */
    public static function storeProfilePhoto($file): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $realPath = $file->getRealPath();
        if (!$realPath || !is_readable($realPath)) {
            return null;
        }

        $rawBytes = @file_get_contents($realPath);
        if ($rawBytes === false || $rawBytes === '') {
            return null;
        }

        $imgInfo = @getimagesizefromstring($rawBytes);
        if (!$imgInfo || empty($imgInfo['mime'])) {
            return null;
        }

        $mimeMap = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/pjpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];
        $detectedMime = strtolower($imgInfo['mime']);
        if (!isset($mimeMap[$detectedMime])) {
            return null;
        }

        $ext = $mimeMap[$detectedMime];
        $mime = ($ext === 'jpg') ? 'image/jpeg' : $detectedMime;
        $cardname = \Illuminate\Support\Str::random(8) . '_' . time() . '.' . $ext;

        // Build a compact resized copy (max 400x400) when GD is available for fast DB/serverless fallback
        $compactBytes = $rawBytes;
        $compactMime = $mime;
        $origW = (int) ($imgInfo[0] ?? 0);
        $origH = (int) ($imgInfo[1] ?? 0);

        if (
            function_exists('imagecreatefromstring') &&
            function_exists('imagecreatetruecolor') &&
            $origW > 0 &&
            $origH > 0 &&
            ($origW > 400 || $origH > 400 || strlen($rawBytes) > 200000)
        ) {
            try {
                $srcImg = @imagecreatefromstring($rawBytes);
                if ($srcImg !== false) {
                    $scale = min(400 / $origW, 400 / $origH, 1);
                    $newW = max(1, (int) round($origW * $scale));
                    $newH = max(1, (int) round($origH * $scale));
                    $dstImg = imagecreatetruecolor($newW, $newH);

                    if ($ext === 'png' || $ext === 'webp' || $ext === 'gif') {
                        imagealphablending($dstImg, false);
                        imagesavealpha($dstImg, true);
                        $transparent = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
                        imagefilledrectangle($dstImg, 0, 0, $newW, $newH, $transparent);
                    }

                    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newW, $newH, $origW, $origH);

                    ob_start();
                    if ($ext === 'png') {
                        imagepng($dstImg, null, 7);
                        $compactMime = 'image/png';
                    } else {
                        imagejpeg($dstImg, null, 85);
                        $compactMime = 'image/jpeg';
                    }
                    $encoded = ob_get_clean();

                    @imagedestroy($srcImg);
                    @imagedestroy($dstImg);

                    if ($encoded !== false && $encoded !== '') {
                        $compactBytes = $encoded;
                    }
                }
            } catch (\Throwable $e) {
                $compactBytes = $rawBytes;
                $compactMime = $mime;
            }
        }

        // Write physical file to persistent storage/app/public/photos (cPanel) and runtime storage_path
        $basePhotosDir = base_path('storage/app/public/photos');
        $runtimePhotosDir = storage_path('app/public/photos');
        $persistentWritable = false;

        if (!is_dir($basePhotosDir)) {
            @mkdir($basePhotosDir, 0775, true);
        }
        if (is_dir($basePhotosDir) && is_writable($basePhotosDir)) {
            if (@file_put_contents($basePhotosDir . '/' . $cardname, $rawBytes) !== false) {
                @chmod($basePhotosDir . '/' . $cardname, 0644);
                $persistentWritable = true;
            }
        }

        if ($runtimePhotosDir !== $basePhotosDir) {
            if (!is_dir($runtimePhotosDir)) {
                @mkdir($runtimePhotosDir, 0775, true);
            }
            if (is_dir($runtimePhotosDir) && is_writable($runtimePhotosDir)) {
                @file_put_contents($runtimePhotosDir . '/' . $cardname, $rawBytes);
                @chmod($runtimePhotosDir . '/' . $cardname, 0644);
            }
        }

        foreach ([public_path('storage/app/public/photos'), public_path('storage/photos')] as $pubDir) {
            if (is_dir($pubDir) && is_writable($pubDir) && realpath($pubDir) !== realpath($basePhotosDir)) {
                @file_put_contents($pubDir . '/' . $cardname, $rawBytes);
                @chmod($pubDir . '/' . $cardname, 0644);
            }
        }

        // Store compact base64 backup in `images` table so /profile-photo/{filename} works even if storage paths change
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('images') && strlen($compactBytes) <= 1500000) {
                \Illuminate\Support\Facades\DB::table('images')->insert([
                    'ref_key' => 'profile:' . $cardname,
                    'title' => $compactMime,
                    'description' => base64_encode($compactBytes),
                    'img_path' => 'photos/' . $cardname,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $e) {
            // Non-fatal if images table is unavailable
        }

        // On read-only serverless filesystems with SQLite (e.g. Vercel), persist inline data URI directly
        if (!$persistentWritable) {
            try {
                if (\Illuminate\Support\Facades\DB::connection()->getDriverName() === 'sqlite') {
                    return 'data:' . $compactMime . ';base64,' . base64_encode($compactBytes);
                }
            } catch (\Throwable $e) {
                // Fall back to filename
            }
        }

        return $cardname;
    }

    public function getCurrencyCodeAttribute(): string
    {
        if (!empty($this->acnt_type_active) && strpos($this->acnt_type_active, '|') !== false) {
            $parts = explode('|', $this->acnt_type_active, 2);
            if (!empty($parts[0])) {
                return $parts[0];
            }
        }
        $settings = Settings::find(1);
        return $settings ? ($settings->getRawOriginal('s_currency') ?: 'USD') : 'USD';
    }

    public function getCurrencySymbolAttribute(): string
    {
        if (!empty($this->acnt_type_active) && strpos($this->acnt_type_active, '|') !== false) {
            $parts = explode('|', $this->acnt_type_active, 2);
            if (!empty($parts[1])) {
                return $parts[1];
            }
        }
        $settings = Settings::find(1);
        return $settings ? ($settings->getRawOriginal('currency') ?: '$') : '$';
    }

    public function wd(){
    	return $this->hasMany(Withdrawal::class, 'user');
    }

    public function tuser(){
    	return $this->belongsTo(Admin::class, 'assign_to');
    }
    
    public function dplan(){
    	return $this->belongsTo(Plans::class, 'plan');
    }

    public function plans(){
        return $this->hasMany(User_plans::class,'user', 'id');
    }

    public static function search($search): \Illuminate\Database\Eloquent\Builder
    {
        return empty($search) ? static::query()
        : static::query()->where('id', 'like', '%'.$search.'%')
        ->orWhere('name', 'like', '%'.$search.'%')
        ->orWhere('username', 'like', '%'.$search.'%')
        ->orWhere('email', 'like', '%'.$search.'%');
    }
	
    /**
     * Get the cards for the user.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    /**
     * Get the notifications associated with the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the count of unread notifications for this user.
     * 
     * @return int
     */
    public function unreadNotificationsCount()
    {
        return $this->notifications()->where('is_read', false)->count();
    }
}
