@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Sovereign Metal & Virtual Cards — Orvatio Holders')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Sovereign Metal &amp; Virtual Cards</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Cards</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} CARD ISSUANCE</span>
<h4>{{ pc('cards','intro_heading') }}</h4>
</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
                       <div class="row">
                         <div class="col-sm-12">
                            <div class="panel panel-default">
                             <div class="panel-body">
                               <h4><img src="temp/custom/images/3527271.png?v=orvatio1" width="25px"> &nbsp;DIRECT PRINCIPAL ISSUANCE ACROSS GLOBAL NETWORKS</h4>
                               <hr>

                               <div class="row">

                                <div class="col-sm-3" align="center">
                                 <img src="temp/custom/images/349221.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">VISA INFINITE PRIVILEGE</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                </div>

                                <div class="col-sm-3" align="center">
                                  <img src="temp/custom/images/147258.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">MASTERCARD WORLD ELITE</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/349228.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">AMERICAN EXPRESS CENTURION LINE</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/349230.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">DISCOVER GLOBAL NETWORK</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>
                                 
                               </div>

                               <br>
                               
                             </div>
                           </div>
                         </div>
                       </div>
                       
<br><br><br>
                       <div class="row align-items-center">
                         <div class="col-sm-2"></div>
                         <div class="col-sm-4 text-center">
                            <img src="temp/custom/images/1086741.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="150">
                         </div>
                         <div class="col-sm-4">
                         	<h3>{{ pc('cards','apply_heading') }}</h3>
                         	<p>{{ pc('cards','apply_body') }}</p>
                         	<br>
                         	<a href="login" class="btn style1">Commission Your Card<i class="ri-arrow-right-s-line"></i></a>
                         </div>
                         <div class="col-sm-2"></div>
                       </div>
                       <br><br><br>
		</div>
	</div>
</div>

<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-bank-card-line"></i>
</span>
<h3><a href="login">Instant Virtual Provisioning</a></h3>
</div>
<p>Generate disposable or recurring virtual cards in seconds and pair them immediately with Apple Pay and Google Wallet.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-equalizer-line"></i>
</span>
<h3><a href="login">Granular Spend Governance</a></h3>
</div>
<p>Set per-transaction, daily, geographic, or merchant-category controls across family members and corporate executives.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-global-line"></i>
</span>
<h3><a href="login">True Interbank FX</a></h3>
</div>
<p>Auto-debit directly from matching currency vaults or convert across 150+ currencies with zero foreign transaction fees.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-gift-line"></i>
</span>
<h3><a href="register">3.5% Uncapped Rebates</a></h3>
</div>
<p>Earn up to 3.5% automatic cashback on global travel, dining, and corporate procurement, credited directly to your vault.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-lock-password-line"></i>
</span>
<h3><a href="login">Biometric 3D Secure</a></h3>
</div>
<p>Freeze or unfreeze cards with one tap and authorize high-value online transactions via hardware passkey or Face ID.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-vip-crown-line"></i>
</span>
<h3><a href="register">1,400+ Lounge Access</a></h3>
</div>
<p>Enjoy unlimited private airport lounge entry, comprehensive medical and aviation cover, and 24/7 lifestyle concierge.</p>
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
<img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Cards App">
</div>
</div>
<div class="col-lg-6">
<div class="app-content">
<div class="content-title style1">
<span>INTELLIGENT CARD CONTROL</span>
<h2>{{ pc('cards','app_heading') }}</h2>
<p>{{ pc('cards','app_body') }}</p>
</div>
<h5>{{ pc('cards','app_stat') }}</h5>
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
