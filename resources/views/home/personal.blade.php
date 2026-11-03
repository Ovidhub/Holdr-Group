@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Private & Personal Banking')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Private &amp; Personal Banking</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Personal Banking</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} PRIVATE CLIENT</span>
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
			<li><i class="ri-checkbox-multiple-line"></i><strong>Integrated Current &amp; High-Yield Vaults:</strong> Pair instant-access everyday checking with interest-bearing liquidity vaults that grow your capital automatically.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Borderless Multi-Currency Spending:</strong> Hold and spend in USD, EUR, GBP, CHF, and 45+ additional currencies with real-time interbank conversion and zero foreign transaction markups.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Joint &amp; Family Wealth Accounts:</strong> Configure shared household accounts for up to four joint signatories with customizable spending visibility and instant family transfers.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Priority Global Remittances:</strong> Send funds to family, property escrows, or investment accounts worldwide with instant settlement notifications and full fee transparency.</li>
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
<h3><a href="register">Everyday Current Accounts</a></h3>
</div>
<p>Enjoy fee-free day-to-day banking, instant direct deposits, and automated bill management from one sleek dashboard.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-safe-2-line"></i>
</span>
<h3><a href="register">High-Yield Savings Vaults</a></h3>
</div>
<p>Segregate reserves into goal-based vaults earning competitive institutional yields with daily liquidity.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-plane-line"></i>
</span>
<h3><a href="cards">Fee-Free Global Travel</a></h3>
</div>
<p>Spend abroad at real interbank rates and access international airport lounges with our private client card tiers.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-group-line"></i>
</span>
<h3><a href="register">Joint &amp; Family Accounts</a></h3>
</div>
<p>Manage shared household expenses and multi-generational wealth seamlessly with up to four joint holders.</p>
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
<p>Send domestic and cross-border wires in seconds across 104+ countries with zero hidden intermediary fees.</p>
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
<p>Count on round-the-clock biometric security monitoring and live private client advisors whenever you need assistance.</p>
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
<img src="temp/custom/assets/img/shape-4.png?v=cherry3" alt="Image" class="app-shape-one bounce">
<img src="temp/custom/assets/img/app-screen.png?v=cherry3" alt="Image">
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
<img src="temp/custom/assets/img/about/play-store.png?v=cherry3" alt="Image">
</a><a href="app">
<img src="temp/custom/assets/img/about/app-store.png?v=cherry3" alt="Image">
</a>
</div>
</div>
</div>
</div>
</div>
</section>

</div>

@endsection
