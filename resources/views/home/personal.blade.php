@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Private Client & Personal Banking — Orvatio Holders')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Private Client &amp; Personal Banking</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Private Banking</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} PRIVATE WEALTH</span>
<h4>{{ pc('personal','intro_heading') }}</h4>
</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="single-terms">
			<h3>{{ pc('personal','overview_heading') }}</h3>
			<p>{{ pc('personal','overview_body') }}</p>
			<ul class="content-feature-list list-style">
			<li><i class="ri-checkbox-multiple-line"></i><strong>Sovereign Yield &amp; Everyday Liquidity Vaults:</strong> Combine frictionless day-to-day private checking with segregated high-yield reserve vaults earning up to 5.45% APY.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Multi-Currency Private Accounts:</strong> Hold, convert, and spend across USD, EUR, GBP, CHF, JPY, AED, and 50+ additional currencies at direct interbank rates with zero retail FX markups.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Family Office &amp; Joint Household Governance:</strong> Configure shared family accounts and multi-generational trusts with custom signatory limits and real-time visibility.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Priority Global Wire Execution:</strong> Settle international real estate acquisitions, tuition, and investment subscriptions in seconds with full SWIFT gpi tracking.</li>
			</ul>
			</div>
		</div>
	</div>
</div>

<hr>

<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-wallet-3-line"></i>
</span>
<h3><a href="register">Private Checking</a></h3>
</div>
<p>Enjoy zero monthly maintenance fees, instant domestic wires, and automated wealth sweeping from one refined portal.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-safe-2-line"></i>
</span>
<h3><a href="register">Sovereign Yield Vaults</a></h3>
</div>
<p>Allocate personal reserves into ring-fenced liquidity vaults earning institutional yields with instant daily access.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-plane-line"></i>
</span>
<h3><a href="cards">Global Lifestyle &amp; Travel</a></h3>
</div>
<p>Spend worldwide with zero FX fees and enjoy complimentary entry to 1,400+ private airport lounges globally.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-group-line"></i>
</span>
<h3><a href="register">Joint &amp; Family Mandates</a></h3>
</div>
<p>Structure shared household accounts and family allowances seamlessly with up to four verified co-signatories.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-send-plane-fill"></i>
</span>
<h3><a href="login">Instant Global Transfers</a></h3>
</div>
<p>Dispatch domestic and cross-border wires across 108+ jurisdictions with zero hidden correspondent deductions.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-shield-keyhole-line"></i>
</span>
<h3><a href="contact">24/7 Private Concierge</a></h3>
</div>
<p>Rely on dedicated private bankers and continuous biometric security monitoring whenever and wherever you travel.</p>
</div>
</div>
 </div>
</div>
</div>


<section class="app-wrap style1 ptb-100 bg-whisper">
<div class="container">
<div class="row gx-5 align-items-center">
<div class="col-lg-6">
<div class="app-img-wrap">
<img src="temp/custom/assets/img/shape-4.png?v=orvatio1" alt="Shape" class="app-shape-one bounce">
<img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Private App">
</div>
</div>
<div class="col-lg-6">
<div class="app-content">
<div class="content-title style1">
<span>PRIVATE MOBILE BANKING</span>
<h2>{{ pc('personal','app_heading') }}</h2>
<p>{{ pc('personal','app_body') }}</p>
</div>
<h5>{{ pc('personal','app_stat') }}</h5>
<div class="app-btn-wrap">
<a href="app">
<img src="temp/custom/assets/img/about/play-store.png?v=orvatio1" alt="Google Play">
</a><a href="app">
<img src="temp/custom/assets/img/about/app-store.png?v=orvatio1" alt="App Store">
</a>
</div>
</div>
</div>
</div>
</div>
</section>

</div>

@endsection
