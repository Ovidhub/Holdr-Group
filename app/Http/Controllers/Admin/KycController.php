<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NewNotification;
use App\Models\Kyc;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller
{
    public function processKyc(Request $request)
    {
        $application = Kyc::find($request->kyc_id);
        if (!$application) {
            return redirect()->route('kyc')->with('message', 'KYC Application not found.');
        }
        $user = User::where('id', $application->user_id)->first();
        if (!$user) {
            return redirect()->route('kyc')->with('message', 'User associated with KYC Application not found.');
        }

        if ($request->action == 'Accept') {
            User::where('id', $user->id)
                ->update([
                    'account_verify' => 'Verified',
                ]);
            $application->status = "Verified";
            $application->save();

            NotificationHelper::create(
                $user,
                'Your KYC verification has been reviewed and approved. Your account is now fully verified.',
                'KYC Verification Approved',
                'success',
                'check-circle',
                route('account.verify')
            );
        } else {
            try {
                if (!empty($application->frontimg)) {
                    @Storage::disk('public')->delete($application->frontimg);
                }
                if (!empty($application->backimg)) {
                    @Storage::disk('public')->delete($application->backimg);
                }
            } catch (\Throwable $e) {
            }

            $user->account_verify = 'Rejected';
            $user->save();

            NotificationHelper::create(
                $user,
                'Your KYC verification was not approved. Please review the requirements and submit new documents.',
                'KYC Verification Rejected',
                'danger',
                'x-circle',
                route('account.verify')
            );

            $application->delete();
        }

        try {
            Mail::to($user->email)->send(new NewNotification($request->message ?? 'Your KYC status has been updated.', $request->subject ?? 'KYC Update', $user->name));
        } catch (\Throwable $e) {
        }
        return redirect()->route('kyc')->with('success', 'Action Sucessful!');
    }
}
