@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@section('title', 'Private Client FAQ — Orvatio Holders')

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
<li>Client Briefing &amp; FAQ</li>
</ul>
</div>
</div>
</div>

<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} CLIENT BRIEFING</span>
<h2>Direct Answers on Sovereign Custody, Global Clearing, Metal Cards, and Lombard Credit</h2>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-bank-line"></i></span>
<h3>How rapidly can a private or corporate account be onboarded?</h3>
</div>
<p>Private individual mandates can be initiated digitally in under five minutes. Multi-entity corporate treasury and family office structures typically complete compliance onboarding within 24 hours.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-global-line"></i></span>
<h3>Which currencies and institutional clearing networks are supported?</h3>
</div>
<p>We support holding, converting, and settling across 55+ currencies in 108+ jurisdictions via SWIFT gpi, SEPA Instant, USD Fedwire, ACH, CHAPS, and UK Faster Payments at wholesale interbank rates.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-shield-check-line"></i></span>
<h3>How are my deposits and custodial assets ring-fenced?</h3>
</div>
<p>All client balances are 100% ring-fenced inside tier-one sovereign safeguarding vaults, fortified by hardware passkeys, biometric authorization, and continuous cryptographic ledger verification.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-bank-card-line"></i></span>
<h3>Can I issue metal and virtual cards for family members or executives?</h3>
</div>
<p>Yes. Account holders can immediately provision single-use or recurring virtual cards and commission physical Visa Infinite, Mastercard World Elite, or American Express cards with custom spend caps.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-hand-coin-line"></i></span>
<h3>How do {{$settings->site_name}} Lombard and commercial credit lines work?</h3>
</div>
<p>We underwrite Lombard portfolio liquidity lines, prime international mortgages, aviation/fleet finance, and revolving commercial credit with 24-hour preliminary term sheets and zero prepayment penalties.</p>
</div>
</div>

<div class="col-lg-6 mb-4">
<div class="feature-card style3">
<div class="feature-title">
<span><i class="ri-customer-service-2-line"></i></span>
<h3>How do I contact my dedicated relationship principal?</h3>
</div>
<p>Our private client and corporate treasury desks in Zürich and New York operate 24/7/365. Message your banker directly inside the portal, email {{ pc('contact','email_value') }}, or call {{ pc('contact','phone_value') }}.</p>
</div>
</div>
</div>
</div>
</div>

</div>
@endsection
