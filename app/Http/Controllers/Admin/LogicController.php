<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;

class LogicController extends Controller
{
    /**
     * Register a user as an agent (referral manager).
     * Called from resources/views/admin/agents.blade.php
     */
    public function addagent(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
            'referred_users' => 'nullable|numeric|min:0',
        ]);

        $referred = (int) $request->input('referred_users', 0);

        $agent = Agent::firstOrNew(['agent' => $request->user]);

        // Increment existing referral count when the agent already exists.
        $agent->total_refered = (int) $agent->total_refered + $referred;
        $agent->save();

        return redirect()->back()->with('success', 'Agent saved successfully');
    }

    /**
     * View an agent and the users they have referred.
     */
    public function viewagent($agent)
    {
        return view('admin.viewagent')->with([
            'title' => 'Agent record',
            'agent' => User::where('id', $agent)->first(),
            'ag_r'  => User::where('ref_by', $agent)->get(),
        ]);
    }

    /**
     * Remove an agent.
     */
    public function delagent($id)
    {
        Agent::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Agent removed successfully');
    }
}
