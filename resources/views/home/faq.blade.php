@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@section('title', 'Frequently Asked Questions')

@inject('content', 'App\Http\Controllers\FrontController')
@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Frequently Asked Questions</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Help &amp; FAQ</li>
</ul>
</div>
</div>
</div>

<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} KNOWLEDGE BASE</span>
<h2>Clear Answers on Custody, Global Clearing, Cards, and Credit</h2>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-bank-line"></i></span>
<h3>How quickly can I open a {{$settings->site_name}} account?</h3>
</div>
<p>Private personal accounts can be initiated online in under five minutes. Commercial and multi-entity corporate treasury accounts typically complete compliance verification within 24 hours.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-global-line"></i></span>
<h3>Which currencies and clearing rails do you support?</h3>
</div>
<p>We support holding, converting, and settling in 50+ currencies across 104+ countries via SWIFT, SEPA Instant, USD Fedwire, ACH, and UK Faster Payments at real-time interbank rates.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-shield-check-line"></i></span>
<h3>How are my deposits and custodial assets safeguarded?</h3>
</div>
<p>Client funds are held in segregated tier-one safeguarding accounts, protected by hardware-grade encryption, biometric passkeys, and continuous real-time fraud telemetry.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-bank-card-line"></i></span>
<h3>Can I issue virtual and physical cards for my team or family?</h3>
</div>
<p>Yes. Account holders can instantly generate single-use or recurring virtual cards and order physical Visa, Mastercard, American Express, or Discover cards with granular spend limits.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-hand-coin-line"></i></span>
<h3>How do {{$settings->site_name}} credit facilities work?</h3>
</div>
<p>We underwrite residential mortgages, automotive fleet loans, commercial working capital lines, and Lombard liquidity facilities with rapid 24-hour preliminary decisions and zero prepayment penalties.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-customer-service-2-line"></i></span>
<h3>How do I reach my dedicated relationship advisor?</h3>
</div>
<p>Our private client and corporate treasury desk operates 24/7. Reach us directly through your online banking portal, via email at {{ pc('contact','email_value') }}, or by phone at {{ pc('contact','phone_value') }}.</p>
</div>
</div>
</div>
</div>
</div>

</div>
@endsection
