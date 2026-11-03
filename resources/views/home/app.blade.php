@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Mobile Banking Suite')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>{{$settings->site_name}} Mobile Command App</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Mobile App</li>
</ul>
</div>
</div>
</div>

<br><br><br><br>
<div class="container">
	<div class="row align-items-center">
		<div class="col-sm-12 text-center">
			<img src="temp/custom/images/105536.png?v=cherry3" width="120px" alt="Mobile Banking"><br><br>
			<h3>Instant Web &amp; Mobile Portal Access</h3>
			<p class="mt-2">Our Progressive Web Banking Suite works immediately across iOS, Android, macOS, and Windows devices—with biometric passkey support and zero regional app-store restrictions.</p>
			<a href="login" class="btn style1 mt-3">Launch Online Banking Portal<i class="ri-arrow-right-s-line"></i></a>
		</div>
	</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<hr>
<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-apple-fill"></i>
</span>
<h3><a href="login">Apple iOS &amp; iPadOS</a></h3>
</div>
<p>Full Face ID &amp; Touch ID authentication, Apple Pay card provisioning, and real-time push telemetry.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-android-fill"></i>
</span>
<h3><a href="login">Google Android</a></h3>
</div>
<p>Biometric vault access, Google Wallet integration, and instant multi-currency QR and IBAN transfers.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-macbook-line"></i>
</span>
<h3><a href="login">Desktop Treasury Terminal</a></h3>
</div>
<p>Manage batch payroll, multi-entity ledgers, FX forward contracts, and downloadable audit statements.</p>
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
<a href="login">
<img src="temp/custom/assets/img/about/play-store.png?v=cherry3" alt="Image">
</a><a href="login">
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
