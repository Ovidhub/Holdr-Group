<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use App\Models\AppearanceSettings;

class AppearanceSettingsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get appearance settings. Guard against the table being missing
        // (fresh install / before migrations) so requests do not 500.
        $appearanceSettings = null;

        try {
            if (Schema::hasTable('appearance_settings')) {
                $appearanceSettings = AppearanceSettings::first();
            }
        } catch (QueryException $e) {
            $appearanceSettings = null;
        }

        // Share settings with all views
        view()->share('appearanceSettings', $appearanceSettings);

        return $next($request);
    }
} 