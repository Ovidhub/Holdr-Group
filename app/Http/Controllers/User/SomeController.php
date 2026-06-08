<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SomeController extends Controller
{
    /**
     * Toggle the authenticated user's dashboard theme (light/dark).
     * Mirrors Admin\ManageAdminController@changestyle for the user dashboard.
     */
    public function changetheme(Request $request)
    {
        $dashboard_style = (isset($request['style']) && $request['style'] == 'true')
            ? 'dark'
            : 'light';

        User::where('id', Auth::id())->update([
            'dashboard_style' => $dashboard_style,
        ]);

        return response()->json(['success' => 'Changed']);
    }
}
