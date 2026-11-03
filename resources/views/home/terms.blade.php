@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@section('title', 'Terms of Custody & Data Governance')

@section('content')

<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Terms of Custody &amp; Data Governance</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Terms of Custody</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} FIDUCIARY &amp; DATA CHARTER</span>
<h4>How {{$settings->site_name}} safeguards your personal identity, corporate records, and custodial assets.</h4>
</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="single-terms">
			<h3>1. Institutional Data Controller &amp; Scope</h3>
			<p>{{$settings->site_name}} ("the Institution") acts as the fiduciary data controller for all personal and corporate records submitted through our digital banking platforms, APIs, and private advisory desks. You may reach our Data Protection &amp; Compliance Officer at {{ pc('contact','location_value') }} or via electronic mail at {{ pc('contact','email_value') }}.</p>

			<p>This Charter outlines how we collect, verify, encrypt, and retain client information across the {{$settings->site_name}} online banking ecosystem. We adhere strictly to international financial privacy frameworks, Know-Your-Customer (KYC) statutes, and Anti-Money Laundering (AML) regulations.</p>

			<h3>2. Categories of Information Collected</h3>
			<p>To provision multi-currency accounts, execute domestic and cross-border wires, issue payment cards, and underwrite credit facilities, we process the following verified data categories:</p>
			<ul class="content-feature-list list-style">
				<li><i class="ri-checkbox-multiple-line"></i><strong>Identity &amp; Corporate Verification:</strong> Full legal name, date of birth, government-issued photographic identification, residential address history, and (for commercial entities) articles of incorporation, beneficial ownership registers, and board mandates.</li>
				<li><i class="ri-checkbox-multiple-line"></i><strong>Financial &amp; Treasury Profile:</strong> Source of funds, income and balance sheet documentation, tax residency identifiers, and external counterparty banking credentials required for clearing.</li>
				<li><i class="ri-checkbox-multiple-line"></i><strong>Cryptographic &amp; Telemetry Logs:</strong> Device fingerprints, IP addresses, hardware security key attestations, and biometric verification tokens used to prevent unauthorized account access.</li>
			</ul>

			<h3>3. Custodial Safeguarding &amp; Zero-Sale Commitment</h3>
			<p>{{$settings->site_name}} never sells, rents, or monetizes client data. Information is shared strictly with regulated clearing networks (such as SWIFT, SEPA, Fedwire, and Faster Payments), card schemes, and statutory authorities where required by law to execute your instructions or fulfill regulatory obligations.</p>
			</div>
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
<span>MOBILE COMMAND CENTER</span>
<h2>{{ pc('home','app_heading') }}</h2>
<p>{{ pc('home','app_body') }}</p>
</div>
<h5>{{ pc('home','app_stat') }}</h5>
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
