<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use App\Models\User_plans;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UserInvPlanController extends Controller
{
    public function loan(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $settings = Settings::where('id', '=', '1')->first();
        $plan_price = $request['amount'] ?? 0;
        $durationMonths = is_numeric($request['duration']) ? (int) $request['duration'] : 12;
        $end_at = Carbon::now()->addMonths(max(1, $durationMonths));

        $userplanid = DB::table('user_plans')->insertGetId([
            'user' => Auth::user()->id,
            'amount' => $plan_price,
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

        $message = "This is to inform you that $user->name just applied for a loan plan for $request->purpose";
        $subject = "Loan Application by $user->name ";
        Mail::to(optional($settings)->contact_email)->send(new NewNotification($message, $subject, 'Admin'));

        return redirect()->back()
            ->with('success', "You have successfully applied for a loan your loan is currently pending, you will be contacted soon.");
    }

    public function cancelPlan($plan)
    {
        $plan = User_plans::find($plan);
        if (!$plan) {
            return back()->with('message', 'Plan not found');
        }
        $plan->active = 'cancelled';
        $plan->save();

        User::where('id', $plan->user)->update([
            'account_bal' => Auth::user()->account_bal + $plan->amount,
        ]);

        $planName = optional($plan->dplan)->name ?? 'Investment Plan';

        $th = new Tp_Transaction();
        $th->plan = $planName;
        $th->user = $plan->user;
        $th->amount = $plan->amount;
        $th->type = "Investment capital for cancelled plan";
        $th->save();

        $message = "You have succesfully cancelled your $planName plan and your investment capital have been credited to your account,  If this is a mistake, please contact us immediately to reactivate it for you.";
        Mail::to(Auth::user()->email)->send(new NewNotification($message, 'Investment Plan Cancelled', Auth::user()->name));

        return back()->with('success', 'Plan cancelled successfully');
    }
}
