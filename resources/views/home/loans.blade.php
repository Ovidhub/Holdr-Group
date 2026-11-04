@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Lombard Credit & Commercial Lending — Orvatio Holders')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Lombard Credit &amp; Commercial Lending</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Credit &amp; Lending</li>
</ul>
</div>
</div>
</div>


<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} CREDIT COMMITTEE</span>
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
                               <h4><img src="temp/custom/images/3527271.png?v=orvatio1" width="25px"> &nbsp;BESPOKE PRIVATE &amp; INSTITUTIONAL CREDIT LINES</h4>
                               <hr>

                               <div class="row">

                                <div class="col-sm-3" align="center">
                                 <img src="temp/custom/images/5207009.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">AVIATION, MARINE &amp; FLEET FINANCE</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                </div>

                                <div class="col-sm-3" align="center">
                                  <img src="temp/custom/images/4221696.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">PRIME RESIDENTIAL &amp; COMMERCIAL REAL ESTATE</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/3130571.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">REVOLVING CORPORATE EXPANSION CREDIT</span><br><br>
                                  <div class="hidden-md hidden-lg"><hr></div>
                                 </div>

                                 <div class="col-sm-3" align="center">
                                   <img src="temp/custom/images/2780256.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="50">
                                  <br>
                                  <span style="font-size:14px; font-weight:600;">LOMBARD PORTFOLIO LIQUIDITY LINES</span><br><br>
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
                            <img src="temp/custom/images/1907675.png?v=orvatio1" class="img-responsive" style="margin-top: 15px;" width="150">
                         </div>
                         <div class="col-sm-4">
                          <h3>{{ pc('loans','apply_heading') }}</h3>
                          <p>{{ pc('loans','apply_body') }}</p>
                          <br>
                          <a href="login" class="btn style1">Initiate Credit Mandate<i class="ri-arrow-right-s-line"></i></a>
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
<h3><a href="login">24-Hour Credit Term Sheets</a></h3>
</div>
<p>Receive binding credit committee term sheets within 24 hours backed by direct digital underwriting and dedicated credit principals.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-percent-line"></i>
</span>
<h3><a href="login">Institutional Benchmark Rates</a></h3>
</div>
<p>Borrow at competitive fixed or SOFR/SARON/SONIA-linked variable rates scaled to your custodial relationship and collateral tier.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-calendar-check-line"></i>
</span>
<h3><a href="login">Tailored Amortization</a></h3>
</div>
<p>Select custom repayment horizons from 6 to 360 months with interest-only structuring and zero early-repayment penalties.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-building-2-line"></i>
</span>
<h3><a href="business">Corporate &amp; Trade Facilities</a></h3>
</div>
<p>Finance cross-border supply chains, M&amp;A bridge tranches, and capital equipment without diluting shareholder equity.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-home-heart-line"></i>
</span>
<h3><a href="personal">Cross-Border Prime Mortgages</a></h3>
</div>
<p>Acquire residential and commercial estates in Zürich, London, New York, Dubai, and Singapore with multi-currency servicing.</p>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="feature-card style3">
<div class="feature-title">
<span>
<i class="ri-user-star-line"></i>
</span>
<h3><a href="contact">Sovereign Lombard Lines</a></h3>
</div>
<p>Draw immediate multi-currency liquidity against your held cash vaults and investment portfolios without triggering taxable sales.</p>
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
<img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Credit Suite">
</div>
</div>
<div class="col-lg-6">
<div class="app-content">
<div class="content-title style1">
<span>DIGITAL CREDIT TERMINAL</span>
<h2>{{ pc('loans','app_heading') }}</h2>
<p>{{ pc('loans','app_body') }}</p>
</div>
<h5>{{ pc('loans','app_stat') }}</h5>
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
