@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Credit Facilities & Loans')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Credit Facilities &amp; Loans</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Credit &amp; Loans</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} LENDING DESK</span>
<h4>{{ pc('loans','intro_heading') }}</h4>
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
                               <h4><img src="temp/custom/images/3527271.png?v=cherry3" width="25px"> &nbsp;STRUCTURED LENDING PORTFOLIOS</h4>
                               <hr>

                               <div class="row">

                                <div class="col-sm-3" align="center">
                                 <img src="temp/custom/images/5207009.png?v=cherry3" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">AUTOMOTIVE &amp; FLEET CREDIT</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                </div>

                                <div class="col-sm-3" align="center">
                                  <img src="temp/custom/images/4221696.png?v=cherry3" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">RESIDENTIAL &amp; PRIME MORTGAGES</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/3130571.png?v=cherry3" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">COMMERCIAL EXPANSION LINES</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/2780256.png?v=cherry3" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">HEALTHCARE &amp; PRIVATE LIQUIDITY</span><br><br>
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
                            <img src="temp/custom/images/1907675.png?v=cherry3" class="img-responsive" style="margin-top: 15px;" width="150">
                         </div>
                         <div class="col-sm-4">
                          <h3>{{ pc('loans','apply_heading') }}</h3>
                          <p>{{ pc('loans','apply_body') }}</p>
                          <br>
                          <a href="login" class="btn style1">Submit Credit Application<i class="ri-arrow-right-s-line"></i></a>
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
<i class="ri-timer-flash-line"></i>
</span>
<h3><a href="login">Rapid Underwriting</a></h3>
</div>
<p>Receive preliminary credit decisions within 24 hours backed by automated financial verification and dedicated credit analysts.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-percent-line"></i>
</span>
<h3><a href="login">Institutional Rate Tiers</a></h3>
</div>
<p>Access competitive fixed and SOFR/SONIA-linked variable rates structured around your relationship balance and collateral profile.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-calendar-check-line"></i>
</span>
<h3><a href="login">Custom Amortization</a></h3>
</div>
<p>Choose flexible repayment tenors from 12 to 360 months with optional interest-only periods and zero early-settlement fees.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-building-2-line"></i>
</span>
<h3><a href="business">Commercial &amp; Asset Finance</a></h3>
</div>
<p>Fund equipment acquisitions, commercial real estate, and working capital cycles without diluting equity.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-home-heart-line"></i>
</span>
<h3><a href="personal">International Mortgages</a></h3>
</div>
<p>Finance primary residences and investment properties across key global cities with multi-currency repayment options.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-user-star-line"></i>
</span>
<h3><a href="contact">Bespoke Lombard Lending</a></h3>
</div>
<p>Unlock immediate liquidity against your held cash vaults and marketable securities without liquidating core positions.</p>
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
<span>DIGITAL LENDING SUITE</span>
<h2>{{ pc('loans','app_heading') }}</h2>
<p>{{ pc('loans','app_body') }}</p>
</div>
<h5>{{ pc('loans','app_stat') }}</h5>
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
