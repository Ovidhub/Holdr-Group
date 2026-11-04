@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Corporate Treasury & Institutional Banking — Orvatio Holders')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Corporate Treasury &amp; Commercial Banking</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Corporate Treasury</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} INSTITUTIONAL TREASURY</span>
<h4>{{ pc('business','intro_heading') }}</h4>
</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="single-terms">
			<h3>{{ pc('business','overview_heading') }}</h3>
			<p>{{ pc('business','overview_body') }}</p>
			<ul class="content-feature-list list-style">
			<li><i class="ri-checkbox-multiple-line"></i><strong>Dedicated Multi-Currency IBANs &amp; Local Clearing:</strong> Provision named corporate accounts across USD, EUR, GBP, CHF, SGD, AED, and 50+ additional currencies to invoice global counterparties and settle trade payables without forced FX conversions.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Automated Batch Treasury &amp; Global Payroll:</strong> Execute up to 10,000 domestic and international disbursements simultaneously via API or ISO 20022 file upload with instant ledger reconciliation.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Wholesale FX Desk &amp; Forward Hedging:</strong> Access direct interbank liquidity, lock in forward exchange contracts, and insulate corporate operating margins from currency volatility.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Multi-Entity Hierarchy &amp; Dual-Signatory Controls:</strong> Consolidate regional subsidiaries, SPVs, and operating entities under one master treasury dashboard with granular role-based approval matrices.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Overnight Sovereign Liquidity Sweeps:</strong> Deploy idle working capital into ring-fenced sovereign Treasury bill vaults earning up to 5.45% APY with same-day liquidity recall.</li>
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
<i class="ri-global-line"></i>
</span>
<h3><a href="register">55+ Currency Ledgers</a></h3>
</div>
<p>Hold, convert, and settle corporate funds across 55+ currencies with local routing details in major financial centers.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-exchange-funds-line"></i>
</span>
<h3><a href="register">ISO 20022 Batch Payouts</a></h3>
</div>
<p>Automate global supplier settlements, partner distributions, and multi-jurisdiction payroll in a single instruction.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-bank-card-2-line"></i>
</span>
<h3><a href="cards">Executive &amp; Team Cards</a></h3>
</div>
<p>Issue brushed-metal executive cards and instant virtual procurement cards with programmable merchant controls.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-title">
</div>
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-shield-check-line"></i>
</span>
<h3><a href="register">Multi-Signatory Governance</a></h3>
</div>
<p>Enforce multi-tiered CFO approval workflows, cryptographic hardware signing, and real-time audit logs.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-line-chart-line"></i>
</span>
<h3><a href="loans">Revolving Credit &amp; Trade</a></h3>
</div>
<p>Access committed revolving working capital facilities, invoice discounting, and documentary letters of credit.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-customer-service-2-line"></i>
</span>
<h3><a href="contact">Dedicated Treasury Principal</a></h3>
</div>
<p>Work directly with an institutional relationship director for bespoke FX hedging, liquidity sweeps, and custom structures.</p>
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
<img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Treasury App">
</div>
</div>
<div class="col-lg-6">
<div class="app-content">
<div class="content-title style1">
<span>EXECUTIVE MOBILE SUITE</span>
<h2>{{ pc('business','app_heading') }}</h2>
<p>{{ pc('business','app_body') }}</p>
</div>
<h5>{{ pc('business','app_stat') }}</h5>
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
