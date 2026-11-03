<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'return_capital' => 'boolean',
        'should_cancel_plan' => 'boolean',
        'modules' => 'array'
    ];

    /**
     * Supported currency catalog: code => [symbol, label]
     */
    public static function availableCurrencies(): array
    {
        return [
            'USD' => ['symbol' => '$', 'name' => 'US Dollar ($ USD)'],
            'EUR' => ['symbol' => '€', 'name' => 'Euro (€ EUR)'],
            'GBP' => ['symbol' => '£', 'name' => 'British Pound (£ GBP)'],
            'CHF' => ['symbol' => 'CHF ', 'name' => 'Swiss Franc (CHF)'],
            'CAD' => ['symbol' => 'CA$', 'name' => 'Canadian Dollar (CA$ CAD)'],
            'AUD' => ['symbol' => 'A$', 'name' => 'Australian Dollar (A$ AUD)'],
            'NZD' => ['symbol' => 'NZ$', 'name' => 'New Zealand Dollar (NZ$ NZD)'],
            'JPY' => ['symbol' => '¥', 'name' => 'Japanese Yen (¥ JPY)'],
            'CNY' => ['symbol' => '¥', 'name' => 'Chinese Yuan (¥ CNY)'],
            'HKD' => ['symbol' => 'HK$', 'name' => 'Hong Kong Dollar (HK$ HKD)'],
            'SGD' => ['symbol' => 'S$', 'name' => 'Singapore Dollar (S$ SGD)'],
            'INR' => ['symbol' => '₹', 'name' => 'Indian Rupee (₹ INR)'],
            'NGN' => ['symbol' => '₦', 'name' => 'Nigerian Naira (₦ NGN)'],
            'AED' => ['symbol' => 'د.إ', 'name' => 'UAE Dirham (د.إ AED)'],
            'SAR' => ['symbol' => '﷼', 'name' => 'Saudi Riyal (﷼ SAR)'],
            'QAR' => ['symbol' => 'QR ', 'name' => 'Qatari Riyal (QR QAR)'],
            'KWD' => ['symbol' => 'KD ', 'name' => 'Kuwaiti Dinar (KD KWD)'],
            'ZAR' => ['symbol' => 'R', 'name' => 'South African Rand (R ZAR)'],
            'KES' => ['symbol' => 'KSh ', 'name' => 'Kenyan Shilling (KSh KES)'],
            'GHS' => ['symbol' => 'GH₵', 'name' => 'Ghanaian Cedi (GH₵ GHS)'],
            'EGP' => ['symbol' => 'E£', 'name' => 'Egyptian Pound (E£ EGP)'],
            'BRL' => ['symbol' => 'R$', 'name' => 'Brazilian Real (R$ BRL)'],
            'MXN' => ['symbol' => 'MX$', 'name' => 'Mexican Peso (MX$ MXN)'],
            'SEK' => ['symbol' => 'kr', 'name' => 'Swedish Krona (kr SEK)'],
            'NOK' => ['symbol' => 'kr', 'name' => 'Norwegian Krone (kr NOK)'],
            'DKK' => ['symbol' => 'kr', 'name' => 'Danish Krone (kr DKK)'],
            'PLN' => ['symbol' => 'zł', 'name' => 'Polish Zloty (zł PLN)'],
            'CZK' => ['symbol' => 'Kč', 'name' => 'Czech Koruna (Kč CZK)'],
            'TRY' => ['symbol' => '₺', 'name' => 'Turkish Lira (₺ TRY)'],
            'KRW' => ['symbol' => '₩', 'name' => 'South Korean Won (₩ KRW)'],
            'PHP' => ['symbol' => '₱', 'name' => 'Philippine Peso (₱ PHP)'],
            'MYR' => ['symbol' => 'RM', 'name' => 'Malaysian Ringgit (RM MYR)'],
            'THB' => ['symbol' => '฿', 'name' => 'Thai Baht (฿ THB)'],
            'IDR' => ['symbol' => 'Rp', 'name' => 'Indonesian Rupiah (Rp IDR)'],
            'PKR' => ['symbol' => '₨', 'name' => 'Pakistani Rupee (₨ PKR)'],
        ];
    }

    /**
     * Resolve currency symbol for the currently authenticated user (if set),
     * falling back to the platform setting.
     */
    public function getCurrencyAttribute($value)
    {
        try {
            if (Auth::guard('web')->check() && !Auth::guard('admin')->check()) {
                $user = Auth::guard('web')->user();
                if ($user && !empty($user->acnt_type_active) && strpos($user->acnt_type_active, '|') !== false) {
                    $parts = explode('|', $user->acnt_type_active, 2);
                    if (!empty($parts[1])) {
                        return $parts[1];
                    }
                }
            }
        } catch (\Throwable $e) {
            // Ignore guard errors during early bootstrap
        }

        return $value ?: '$';
    }

    /**
     * Resolve currency ISO code (s_currency) for the currently authenticated user (if set),
     * falling back to the platform setting.
     */
    public function getSCurrencyAttribute($value)
    {
        try {
            if (Auth::guard('web')->check() && !Auth::guard('admin')->check()) {
                $user = Auth::guard('web')->user();
                if ($user && !empty($user->acnt_type_active) && strpos($user->acnt_type_active, '|') !== false) {
                    $parts = explode('|', $user->acnt_type_active, 2);
                    if (!empty($parts[0])) {
                        return $parts[0];
                    }
                }
            }
        } catch (\Throwable $e) {
            // Ignore guard errors during early bootstrap
        }

        return $value ?: 'USD';
    }
}