<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $settings->site_name }} - Transaction Status & Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('storage/app/public/'.$settings->favicon) }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fff1f3',
                            100: '#ffe4e8',
                            500: '#C41E3A',
                            600: '#C41E3A',
                            700: '#9E152D',
                            800: '#7F0D22',
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        [x-cloak] { display: none !important; }
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                max-width: 100% !important;
                box-shadow: none !important;
                border: none !important;
            }
            .print-break-inside-avoid {
                break-inside: avoid;
            }
        }
        #google_translate_element .goog-te-gadget {
            font-family: inherit !important;
            font-size: 0 !important;
            color: transparent !important;
        }
        #google_translate_element .goog-te-gadget span {
            display: none !important;
        }
        #google_translate_element .goog-te-gadget .goog-te-combo {
            background: transparent !important;
            color: #1f2937 !important;
            border: none !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            padding: 2px 4px !important;
            outline: none !important;
            cursor: pointer;
        }
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
    </style>
</head>
@php
    $rawStatus = strtolower(trim($dp->status ?? 'processed'));
    if (in_array($rawStatus, ['blocked', 'rejected', 'failed', 'dormant'])) {
        $txState = 'blocked';
        $txLabel = 'Blocked';
    } elseif (in_array($rawStatus, ['pending', 'on-hold', 'on_hold', 'processing'])) {
        $txState = 'pending';
        $txLabel = $dp->status == 'On-hold' ? 'On-Hold / Pending' : 'Pending';
    } else {
        $txState = 'successful';
        $txLabel = 'Successful';
    }
@endphp
<body class="bg-gray-100 min-h-screen" x-data="{
    isProcessing: true,
    progress: 0,
    step: 1,
    statusTitle: 'Initiating Secure Transfer...',
    statusSub: 'Establishing encrypted banking channel with clearing network',
    txState: '{{ $txState }}',
    init() {
        const interval = setInterval(() => {
            if (this.progress < 100) {
                this.progress += 2;
                if (this.progress >= 25 && this.progress < 55) {
                    this.step = 2;
                    this.statusTitle = 'Verifying Beneficiary & Routing...';
                    this.statusSub = 'Validating {{ addslashes($dp->payment_mode) }} credentials and account standing';
                } else if (this.progress >= 55 && this.progress < 85) {
                    this.step = 3;
                    this.statusTitle = 'Processing Settlement Clearing...';
                    this.statusSub = 'Authorizing {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} transfer instruction';
                } else if (this.progress >= 85) {
                    this.step = 4;
                    this.statusTitle = 'Finalizing Transaction Status...';
                    this.statusSub = 'Generating official settlement confirmation';
                }
            } else {
                clearInterval(interval);
                setTimeout(() => {
                    this.isProcessing = false;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                }, 350);
            }
        }, 70);
    }
}">

    <!-- STEP 1: Live Banking Transfer Loading Animation Process -->
    <div x-show="isProcessing" x-transition.opacity.duration.400ms class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/85 backdrop-blur-md p-4 no-print">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center border border-gray-100">
            <!-- Animated Circular Progress Ring -->
            <div class="relative w-28 h-28 mx-auto mb-6 flex items-center justify-center">
                <svg class="w-full h-full -rotate-90 transform" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="42" stroke="#f3f4f6" stroke-width="8" fill="transparent" />
                    <circle
                        cx="50" cy="50" r="42"
                        stroke="#C41E3A"
                        stroke-width="8"
                        stroke-linecap="round"
                        fill="transparent"
                        stroke-dasharray="264"
                        :stroke-dashoffset="264 - (264 * progress) / 100"
                        class="transition-all duration-100 ease-linear"
                    />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-extrabold text-gray-900" x-text="progress + '%'">0%</span>
                    <span class="text-[10px] uppercase tracking-wider text-primary-600 font-semibold">Processing</span>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-900 mb-1" x-text="statusTitle">Initiating Secure Transfer...</h2>
            <p class="text-sm text-gray-500 mb-6" x-text="statusSub">Establishing encrypted banking channel</p>

            <!-- Linear Progress Bar -->
            <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-primary-600 to-rose-500 h-full rounded-full transition-all duration-100" :style="'width: ' + progress + '%'"></div>
            </div>

            <!-- Live Verification Steps Checklist -->
            <div class="text-left space-y-3 bg-gray-50 p-4 rounded-xl border border-gray-100 text-xs">
                <div class="flex items-center justify-between" :class="step >= 1 ? 'text-gray-900 font-medium' : 'text-gray-400'">
                    <span class="flex items-center">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center mr-2.5 text-white text-[11px]" :class="progress >= 25 ? 'bg-green-500' : 'bg-primary-600 animate-pulse'">
                            <span x-show="progress >= 25">✓</span>
                            <span x-show="progress < 25">1</span>
                        </span>
                        Encrypted Channel & PIN Authentication
                    </span>
                    <span class="text-[11px]" :class="progress >= 25 ? 'text-green-600 font-semibold' : 'text-primary-600'" x-text="progress >= 25 ? 'Verified' : 'In Progress...'"></span>
                </div>

                <div class="flex items-center justify-between" :class="step >= 2 ? 'text-gray-900 font-medium' : 'text-gray-400'">
                    <span class="flex items-center">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center mr-2.5 text-white text-[11px]" :class="progress >= 55 ? 'bg-green-500' : (step >= 2 ? 'bg-primary-600 animate-pulse' : 'bg-gray-300')">
                            <span x-show="progress >= 55">✓</span>
                            <span x-show="progress < 55">2</span>
                        </span>
                        Beneficiary Routing & Compliance Check
                    </span>
                    <span class="text-[11px]" :class="progress >= 55 ? 'text-green-600 font-semibold' : (step >= 2 ? 'text-primary-600' : 'text-gray-400')" x-text="progress >= 55 ? 'Cleared' : (step >= 2 ? 'Checking...' : 'Waiting')"></span>
                </div>

                <div class="flex items-center justify-between" :class="step >= 3 ? 'text-gray-900 font-medium' : 'text-gray-400'">
                    <span class="flex items-center">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center mr-2.5 text-white text-[11px]" :class="progress >= 85 ? 'bg-green-500' : (step >= 3 ? 'bg-primary-600 animate-pulse' : 'bg-gray-300')">
                            <span x-show="progress >= 85">✓</span>
                            <span x-show="progress < 85">3</span>
                        </span>
                        Settlement Network Authorization
                    </span>
                    <span class="text-[11px]" :class="progress >= 85 ? 'text-green-600 font-semibold' : (step >= 3 ? 'text-primary-600' : 'text-gray-400')" x-text="progress >= 85 ? 'Complete' : (step >= 3 ? 'Clearing...' : 'Waiting')"></span>
                </div>

                <div class="flex items-center justify-between" :class="step >= 4 ? 'text-gray-900 font-medium' : 'text-gray-400'">
                    <span class="flex items-center">
                        <span class="w-5 h-5 rounded-full flex items-center justify-center mr-2.5 text-white text-[11px]" :class="progress >= 100 ? 'bg-green-500' : (step >= 4 ? 'bg-primary-600 animate-pulse' : 'bg-gray-300')">
                            <span x-show="progress >= 100">✓</span>
                            <span x-show="progress < 100">4</span>
                        </span>
                        Finalizing Transaction Dispatch
                    </span>
                    <span class="text-[11px]" :class="progress >= 100 ? 'text-green-600 font-semibold' : (step >= 4 ? 'text-primary-600' : 'text-gray-400')" x-text="progress >= 100 ? 'Done' : (step >= 4 ? 'Finalizing...' : 'Waiting')"></span>
                </div>
            </div>

            <p class="text-xs text-gray-400 mt-5">Please do not close or refresh this window while your transfer is being processed.</p>
        </div>
    </div>

    <!-- STEP 2: Final Status & Receipt (Revealed after Loading Animation Completes) -->
    <div x-show="!isProcessing" x-cloak x-transition.opacity.duration.500ms class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto print-container">
            <!-- Action Buttons (No Print) -->
            <div class="flex flex-wrap justify-between items-center mb-4 gap-3 no-print">
                <div class="flex items-center px-3 py-1.5 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <i data-lucide="globe" class="w-4 h-4 text-primary-600 mr-1.5"></i>
                    <div id="google_translate_element"></div>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                        Print Receipt
                    </button>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Status Banner Card (Successful / Pending / Blocked) -->
            @if($txState === 'blocked')
                <div class="mb-6 bg-red-50 border-l-4 border-red-600 rounded-xl p-5 shadow-sm flex items-start">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-2.5 mr-4">
                        <i data-lucide="shield-alert" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-red-900">Transfer Blocked — Account Restricted</h3>
                        <p class="text-sm text-red-700 mt-1">
                            This transfer of <strong>{{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }}</strong> could not be completed because your account is currently marked as dormant or restricted. No funds were deducted. Please contact client support at <strong>{{ $settings->contact_email }}</strong> for immediate assistance.
                        </p>
                    </div>
                </div>
            @elseif($txState === 'pending')
                <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 rounded-xl p-5 shadow-sm flex items-start">
                    <div class="flex-shrink-0 bg-amber-100 rounded-full p-2.5 mr-4">
                        <i data-lucide="clock" class="w-6 h-6 text-amber-600"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-amber-900">Transfer Pending Clearing & Approval</h3>
                        <p class="text-sm text-amber-800 mt-1">
                            Your transfer instruction of <strong>{{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }}</strong> has been queued for compliance verification and clearing. Your transaction status will update automatically once settled.
                        </p>
                    </div>
                </div>
            @else
                <div class="mb-6 bg-green-50 border-l-4 border-green-600 rounded-xl p-5 shadow-sm flex items-start">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-2.5 mr-4">
                        <i data-lucide="check-circle-2" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-green-900">Transfer Successful</h3>
                        <p class="text-sm text-green-700 mt-1">
                            Your transfer of <strong>{{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }}</strong> via <strong>{{ $dp->payment_mode }}</strong> has been processed and dispatched to the beneficiary institution.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Receipt Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 print-break-inside-avoid">
                <!-- Receipt Header -->
                <div class="relative px-6 py-8 text-white {{ $txState === 'blocked' ? 'bg-gradient-to-r from-red-700 to-red-900' : ($txState === 'pending' ? 'bg-gradient-to-r from-amber-600 to-amber-700' : 'bg-gradient-to-r from-primary-600 to-primary-800') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-12 w-auto bg-white/95 p-1.5 rounded-lg" src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="{{ $settings->site_name }}">
                            <div class="ml-4">
                                <h1 class="text-xl font-bold">{{ $settings->site_name }}</h1>
                                <p class="text-sm text-white/80">Official Transaction Receipt</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            @if($txState === 'blocked')
                                <div class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-red-500 text-white shadow-sm">
                                    <i data-lucide="x-circle" class="h-4 w-4 mr-1.5 text-white"></i>
                                    <span class="text-sm font-semibold">{{ $txLabel }}</span>
                                </div>
                            @elseif($txState === 'pending')
                                <div class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-amber-400 text-gray-900 shadow-sm">
                                    <i data-lucide="clock" class="h-4 w-4 mr-1.5 text-gray-900"></i>
                                    <span class="text-sm font-semibold">{{ $txLabel }}</span>
                                </div>
                            @else
                                <div class="inline-flex items-center px-3.5 py-1.5 rounded-full bg-green-500 text-white shadow-sm">
                                    <i data-lucide="check-circle" class="h-4 w-4 mr-1.5 text-white"></i>
                                    <span class="text-sm font-semibold">{{ $txLabel }}</span>
                                </div>
                            @endif
                            <p class="text-sm mt-1.5 text-white/90 font-mono">Ref: {{ $dp->txn_id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Receipt Body -->
                <div class="p-6 md:p-8">
                    <!-- Transaction Info -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Transaction Details</h2>
                        <p class="text-gray-600 text-sm mb-4">
                            @if($txState === 'blocked')
                                Transfer request of {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} via {{ $dp->payment_mode }} was blocked due to account status restrictions.
                            @elseif($txState === 'pending')
                                Transfer request of {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} via {{ $dp->payment_mode }} is currently pending settlement approval.
                            @else
                                @if($dp->payment_mode == 'International Wire Transfer')
                                    You have successfully transferred {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} to {{ $dp->accountname }}.
                                @elseif($dp->payment_mode == 'Domestic Transfer')
                                    You have successfully transferred {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} to {{ $dp->accountname }}.
                                @elseif($dp->payment_mode == 'Cryptocurrency')
                                    You have successfully transferred {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} to the {{ $dp->crypto_currency }} wallet.
                                @else
                                    You have successfully transferred {{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }} via {{ $dp->payment_mode }}.
                                @endif
                            @endif
                        </p>

                        <!-- Transaction Summary Card -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Transaction Date</p>
                                    <div class="flex items-center">
                                        <i data-lucide="calendar" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($dp->date)->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Transaction Time</p>
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($dp->date)->format('h:i A') }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Status</p>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $txState === 'blocked' ? 'bg-red-100 text-red-800' : ($txState === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800') }}">
                                            {{ $txLabel }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Payment Method</p>
                                    <div class="flex items-center">
                                        <i data-lucide="credit-card" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->payment_mode }}</p>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-xs text-gray-500 mb-1">Reference ID</p>
                                    <div class="flex items-center">
                                        <i data-lucide="hash" class="h-4 w-4 text-gray-400 mr-1"></i>
                                        <p class="text-sm font-mono font-medium text-gray-900">{{ $dp->txn_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient Details -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <i data-lucide="user" class="h-5 w-5 text-primary-600 mr-2"></i>
                            <h2 class="text-lg font-bold text-gray-900">Recipient Details</h2>
                        </div>
                        
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            @if($dp->payment_mode == 'International Wire Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountnumber ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Routing / IBAN</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->iban ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Bank Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Type</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->Accounttype ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">SWIFT Code</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->swiftcode ?? 'N/A' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Bank Address</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankaddress ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Country</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->country ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Domestic Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Number</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->accountnumber ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Bank Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->bankname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Account Type</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->Accounttype ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'Cryptocurrency')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Currency</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->crypto_currency ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Network</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->crypto_network ?? 'N/A' }}</p>
                                    </div>
                                    <div class="md:col-span-2">
                                        <p class="text-sm text-gray-500 mb-1">Wallet Address</p>
                                        <p class="text-sm font-medium text-gray-900 break-all">{{ $dp->wallet_address ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @elseif($dp->payment_mode == 'PayPal')
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">PayPal Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $dp->paypal_email ?? 'N/A' }}</p>
                                </div>
                            @elseif($dp->payment_mode == 'Wise Transfer')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_fullname ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Email</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Country</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $dp->wise_country ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Payment Channel</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $dp->payment_mode }}</p>
                                </div>
                            @endif
                            
                            @if($dp->Description)
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <p class="text-sm text-gray-500 mb-1">Description / Memo</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $dp->Description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Financial Details -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <i data-lucide="dollar-sign" class="h-5 w-5 text-primary-600 mr-2"></i>
                            <h2 class="text-lg font-bold text-gray-900">Financial Summary</h2>
                        </div>
                        
                        <div class="overflow-hidden bg-white rounded-lg border border-gray-200">
                            <div class="divide-y divide-gray-200">
                                <div class="grid grid-cols-2 gap-4 p-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Transfer Amount</p>
                                        <p class="text-base font-bold text-gray-900">{{ $settings->currency }}{{ number_format((float)$dp->amount, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Handling & Wire Charges</p>
                                        <p class="text-base font-medium text-gray-900">{{ $settings->currency }}0.00</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm font-semibold text-gray-700">Available Account Balance</p>
                                        <p class="text-lg font-bold text-primary-700">{{ $settings->currency }}{{ number_format((float)$dp->bal, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legal Notice -->
                    <div class="mt-8 text-center border-t border-gray-100 pt-6">
                        <div class="flex justify-center mb-2">
                            <i data-lucide="shield-check" class="h-5 w-5 text-primary-600"></i>
                        </div>
                        <p class="text-xs text-gray-500 mb-1">This electronic receipt is an official record generated by {{ $settings->site_name }}.</p>
                        <p class="text-xs text-gray-400 mt-1">© {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
