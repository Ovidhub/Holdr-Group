@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Commercial & Business Banking')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Commercial &amp; Business Banking</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Business Banking</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} COMMERCIAL TREASURY</span>
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
			<li><i class="ri-checkbox-multiple-line"></i><strong>Global Multi-Currency Operating Accounts:</strong> Open dedicated IBAN, ACH, and Faster Payments accounts in 50+ currencies to invoice clients and settle international suppliers without forced conversions.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Automated Batch Payables &amp; Global Payroll:</strong> Execute thousands of domestic and cross-border disbursements in a single batch with automated beneficiary verification and real-time reconciliation.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Institutional FX Execution &amp; Hedging:</strong> Lock in interbank foreign exchange rates, schedule forward contracts, and protect operating margins across volatile currency corridors.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Multi-Entity Governance &amp; Role Permissions:</strong> Manage subsidiaries, regional divisions, and dual-authorization approval workflows from one consolidated treasury command center.</li>
			<li><i class="ri-checkbox-multiple-line"></i><strong>Revolving Working Capital &amp; Trade Finance:</strong> Access structured credit lines, invoice financing, and documentary letters of credit tailored to your cash conversion cycle.</li>
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
<h3><a href="register">Multi-Currency Ledgers</a></h3>
</div>
<p>Hold, convert, and settle funds across 50+ currencies with local routing details in major commercial hubs.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-exchange-funds-line"></i>
</span>
<h3><a href="register">Batch Payroll &amp; Payouts</a></h3>
</div>
<p>Automate global contractor disbursements, supplier invoices, and multi-country payroll in one click.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-bank-card-2-line"></i>
</span>
<h3><a href="cards">Corporate Spend Cards</a></h3>
</div>
<p>Issue physical and virtual expense cards for teams with programmable merchant and daily spend limits.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-shield-check-line"></i>
</span>
<h3><a href="register">Dual-Signatory Controls</a></h3>
</div>
<p>Enforce custom approval hierarchies, audit trails, and role-based treasury permissions across your finance team.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-line-chart-line"></i>
</span>
<h3><a href="loans">Working Capital Lines</a></h3>
</div>
<p>Draw down revolving commercial credit, asset financing, and trade facilities with transparent terms.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-customer-service-2-line"></i>
</span>
<h3><a href="contact">Dedicated Treasury Desk</a></h3>
</div>
<p>Partner with a senior relationship manager for bespoke FX execution, liquidity sweeps, and custom structures.</p>
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
<span>EXECUTIVE MOBILE SUITE</span>
<h2>{{ pc('business','app_heading') }}</h2>
<p>{{ pc('business','app_body') }}</p>
</div>
<h5>{{ pc('business','app_stat') }}</h5>
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
