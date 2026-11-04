<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Tp_Transaction;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use App\Models\User_plans;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function loan(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $settings = Settings::where('id', '=', '1')->first();

        if ($user->account_status != 'active') {
            return redirect()->back()
                ->with("message", "Sorry, your account is dormant. Contact support on " . optional($settings)->contact_email . " for more details.");
        }

        $durationMonths = is_numeric($request['duration']) ? (int) $request['duration'] : 12;
        $end_at = Carbon::now()->addMonths(max(1, $durationMonths));

        $userplanid = DB::table('user_plans')->insertGetId([
            'user' => Auth::user()->id,
            'amount' => $request['amount'],
            'income' => $request['income'],
            'purpose' => $request['purpose'],
            'duration' => $request['duration'],
            'facility' => $request['facility'],
            'active' => 'Pending',
            'inv_duration' => $request['duration'],
            'expire_date' => $end_at,
            'activated_at' => Carbon::now(),
            'last_growth' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::where('id', Auth::user()->id)->update([
            'user_plan' => $userplanid,
            'entered_at' => Carbon::now(),
        ]);

        NotificationHelper::create(
            $user,
            'Your loan application for ' . $request['amount'] . ' has been submitted successfully and is pending approval. You will be notified once it is processed.',
            'Loan Application Submitted',
            'info',
            'file-text',
            route('veiwloan')
        );

        $message = "This is to inform you that $user->name just applied for a loan plan for $request->purpose";
        $subject = "Loan Application by $user->name ";
        Mail::to(optional($settings)->contact_email)->send(new NewNotification($message, $subject, 'Admin'));

        return redirect()->back()
            ->with('success', "You have successfully applied for a loan your loan is currently pending, you will be contacted soon.");
    }

    public function veiwloans()
    {
        $loans = User_plans::where('user', Auth::user()->id)->orderByDesc('id')->get();
        return view('user.loans', ['loans' => $loans]);
    }
}
