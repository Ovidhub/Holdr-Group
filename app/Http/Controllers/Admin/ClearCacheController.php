<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class ClearCacheController extends Controller
{
    public function clearcache()
    {
        try {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        } catch (\Throwable $e) {
        }
        return redirect()->back()->with('success', 'Cache Cleared Successfully');
    }

    public function saveLicense()
    {
        try {
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $website = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $host;

            Http::timeout(2)->post('http://127.0.0.1:8080/api/v1/save-license', [
                'license' => 'enter license here after verification is done',
                'website' => $website
            ]);
        } catch (\Throwable $e) {
        }

        return response()->json(['status' => 'ok']);
    }
}
