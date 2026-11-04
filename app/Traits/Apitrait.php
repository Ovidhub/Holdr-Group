<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Apitrait
{
    public function get_rate($coin, $currency, $type = null)
    {
        $coinLower = strtolower(trim((string) $coin));
        $defaults = [
            'btc' => 95000.0,
            'eth' => 3200.0,
            'ltc' => 105.0,
            'bnb' => 620.0,
            'xrp' => 2.40,
            'link' => 18.50,
            'bat' => 0.25,
            'aave' => 280.0,
            'usdt' => 1.0,
            'xlm' => 0.42,
            'bch' => 480.0,
            'ada' => 0.95,
            'usd' => 1.0,
        ];

        try {
            $assetbase = $coinLower . strtolower(trim((string) $currency));
            $res = Http::timeout(3)->get("https://api.brynamics.com/api/current-market-price/$assetbase");
            if ($res->successful() && isset($res[0]['Price']) && is_numeric($res[0]['Price']) && $res[0]['Price'] > 0) {
                return (float) $res[0]['Price'];
            }
        } catch (\Throwable $e) {
            // Fall back to built-in market reference rate
        }

        return $defaults[$coinLower] ?? 1.0;
    }
}
