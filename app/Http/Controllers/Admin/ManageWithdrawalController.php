<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Mail\NewNotification;
use App\Traits\PingServer;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Mail;

class ManageWithdrawalController extends Controller
{
    use PingServer;

    // Quick 1-click status change for a user transaction (Successful, Pending, Blocked)
    public function quickStatus($id, $status)
    {
        $withdrawal = Withdrawal::where('id', $id)->first();
        if (!$withdrawal) {
            return redirect()->back()->with('message', 'Transaction not found.');
        }

        $user = User::where('id', $withdrawal->user)->first();
        $settings = Settings::where('id', '=', '1')->first();
        $normalized = strtolower(trim($status));

        if ($normalized === 'successful' || $normalized === 'paid' || $normalized === 'processed') {
            // If previously blocked/rejected, deduct the amount again
            if (in_array(strtolower($withdrawal->status), ['blocked', 'rejected']) && $user) {
                $deduct = (float) ($withdrawal->to_deduct ?: $withdrawal->amount);
                if ($user->account_bal >= $deduct) {
                    User::where('id', $user->id)->update([
                        'account_bal' => $user->account_bal - $deduct,
                    ]);
                }
            }
            Withdrawal::where('id', $id)->update(['status' => 'Processed']);
            if ($user) {
                NotificationHelper::create(
                    $user,
                    'Your transfer of ' . $settings->currency . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been marked as Successful.',
                    'Transfer Successful',
                    'success',
                    'check-circle',
                    route('accounthistory')
                );
            }
            return redirect()->back()->with('success', 'Transaction marked as Successful (Processed).');
        } elseif ($normalized === 'pending' || $normalized === 'on-hold') {
            if (in_array(strtolower($withdrawal->status), ['blocked', 'rejected']) && $user) {
                $deduct = (float) ($withdrawal->to_deduct ?: $withdrawal->amount);
                if ($user->account_bal >= $deduct) {
                    User::where('id', $user->id)->update([
                        'account_bal' => $user->account_bal - $deduct,
                    ]);
                }
            }
            Withdrawal::where('id', $id)->update(['status' => 'Pending']);
            if ($user) {
                NotificationHelper::create(
                    $user,
                    'Your transfer of ' . $settings->currency . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been placed on Pending.',
                    'Transfer Pending',
                    'warning',
                    'clock',
                    route('accounthistory')
                );
            }
            return redirect()->back()->with('success', 'Transaction placed on Pending.');
        } else {
            // Refund user if transaction was previously Pending or Processed
            if (!in_array(strtolower($withdrawal->status), ['blocked', 'rejected']) && $user) {
                $refund = (float) ($withdrawal->to_deduct ?: $withdrawal->amount);
                User::where('id', $user->id)->update([
                    'account_bal' => $user->account_bal + $refund,
                ]);
            }
            Withdrawal::where('id', $id)->update(['status' => 'Blocked']);
            if ($user) {
                NotificationHelper::create(
                    $user,
                    'Your transfer of ' . $settings->currency . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been Blocked.',
                    'Transfer Blocked',
                    'danger',
                    'x-circle',
                    route('accounthistory')
                );
            }
            return redirect()->back()->with('success', 'Transaction has been Blocked.');
        }
    }

    //process withdrawals
    public function pwithdrawal(Request $request)
    {
        $withdrawal=Withdrawal::where('id',$request->id)->first();
        $user=User::where('id',$withdrawal->user)->first();
       
        if (!empty($request->date) && trim($request->date) !== '') {
            $created_at = $request->date;
        } else {
            $created_at = $withdrawal->created_at;
        }
   
        if ($request->action == "Paid" || $request->action == "Successful") {
            if (in_array(strtolower($withdrawal->status), ['blocked', 'rejected']) && $user) {
                $deduct = (float) ($withdrawal->to_deduct ?: $withdrawal->amount);
                if ($user->account_bal >= $deduct) {
                    User::where('id', $user->id)->update([
                        'account_bal' => $user->account_bal - $deduct,
                    ]);
                }
            }
            Withdrawal::where('id',$request->id)
            ->update([
                'status' => 'Processed',
                'created_at'=> $created_at,
            ]);

            // Create notification for successful withdrawal
            NotificationHelper::create(
                $user,
                'Your withdrawal request of ' . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been processed and approved.',
                'Withdrawal Approved',
                'success',
                'check-circle',
                route('withdrawalsdeposits')
            );

            $settings=Settings::where('id', '=', '1')->first();
            $message = "This is to inform you that your transfer request of $settings->currency$withdrawal->amount  to  $withdrawal->accountname  have approved.";

            try {
                Mail::to($user->email)->send(new NewNotification($message, 'Successful Transfer', $user->name));
            } catch (\Throwable $e) {}
        }elseif($request->action == "On-hold" || $request->action == "Pending"){
            Withdrawal::where('id',$request->id)
            ->update([
                'status' => 'Pending',
                'created_at'=> $created_at,
            ]);

            // Create notification for on-hold withdrawal
            NotificationHelper::create(
                $user,
                'Your withdrawal request of ' . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been placed on pending. Please contact support for more information.',
                'Transfer Pending',
                'warning',
                'alert-triangle',
                route('withdrawalsdeposits')
            );

            $settings=Settings::where('id', '=', '1')->first();
            $message = "This is to inform you that your transfer request of $settings->currency$withdrawal->amount to $withdrawal->accountname is currently Pending; contact support on $settings->contact_email for more details ";
     
            try {
                Mail::to($user->email)->send(new NewNotification($message, 'Pending Transfer Transaction', $user->name));
            } catch (\Throwable $e) {}
        }
        else {

            if($withdrawal->user==$user->id){
                if (!in_array(strtolower($withdrawal->status), ['blocked', 'rejected'])) {
                    User::where('id',$user->id)
                    ->update([
                        'account_bal' => $user->account_bal + (float)($withdrawal->to_deduct ?: $withdrawal->amount),
                    ]); 
                }
               
               Withdrawal::where('id',$request->id)
            ->update([
                'status' => ($request->action == 'Blocked' ? 'Blocked' : 'Rejected'),
                'created_at'=> $created_at,
            ]);

                // Create notification for blocked/rejected withdrawal
                NotificationHelper::create(
                    $user,
                    'Your withdrawal request of ' . $withdrawal->amount . ' via ' . $withdrawal->payment_mode . ' has been blocked/rejected.',
                    'Transfer Blocked',
                    'danger',
                    'x-circle',
                    route('withdrawalsdeposits')
                );

                if ($request->emailsend == "true") {
                    try {
                        Mail::to($user->email)->send(new NewNotification($request->reason,$request->subject, $user->name));
                    } catch (\Throwable $e) {}
                }
                
              }
            
        }

        return redirect()->route('mwithdrawals')->with('success', 'Transaction status updated successfully!');
    }

    
    public function processwithdraw($id){
         $with = Withdrawal::where('id',$id)->first();
         $method = Wdmethod::where('name', $with->payment_mode)->first();
         $user = User::where('id', $with->user)->first();
        return view('admin.Withdrawals.pwithrdawal',[
            'withdrawal' => $with,
            'method' => $method,
            'user' => $user,
            'title'=>'Process withdrawal Request',
        ]);
    }
}