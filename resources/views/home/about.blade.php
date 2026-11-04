@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'The Institution — About Orvatio Holders')

@inject('content', 'App\Http\Controllers\FrontController')
@section('content')

  <div class="content-wrapper">

  <div class="breadcrumb-wrap bg-f br-1">
  <div class="container">
  <div class="breadcrumb-title">
  <h2>{{ pc('about','header_title', 'About Orvatio Holders') }}</h2>
  <ul class="breadcrumb-menu list-style">
  <li><a href="/">Home </a></li>
  <li>{{ pc('about','header_title', 'About Orvatio Holders') }}</li>
  </ul>
  </div>
  </div>
  </div>
  
  
  <div class="partner-wrap ptb-100">
  <div class="container">
  <div class="row">
  <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
  <div class="section-title text-center mb-40">
  <h2>Sovereign Private Banking, Multi-Entity Treasury, and Institutional Custody</h2>
  <br>
  <h6>Founded on the Swiss private banking tradition of capital preservation and absolute discretion, {{$settings->site_name}} pairs ring-fenced custodial reserves with real-time cross-border clearing technology across 108 jurisdictions.</h6>
  </div>
  </div>
  </div>
  <div class="partner-slider owl-carousel">
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-1.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-2.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-3.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-4.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-5.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-6.png?v=orvatio1" alt="Partner">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-3.png?v=orvatio1" alt="Partner">
  </div>
  </div>
  </div>
  </div>
  
  
  <section class="about-wrap style1 pb-100">
  <div class="container">
  <div class="row gx-5 align-items-center">
  <div class="col-lg-6">
  <div class="row">
  <div class="col-6 about-img-wrap">
  <img src="temp/custom/assets/img/about/about-shape-4.png?v=orvatio1" alt="Shape" class="about-shape-one bounce">
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-1.jpg?v=orvatio1" alt="Orvatio Holders Zürich">
  </div>
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-2.jpg?v=orvatio1" alt="Private Wealth Desk">
  </div>
  </div>
  <div class="col-6 about-img-wrap lgm-70">
  <img src="temp/custom/assets/img/shape-1.png?v=orvatio1" alt="Shape" class="about-shape-two moveHorizontal">
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-3.jpg?v=orvatio1" alt="Executive Advisory">
  </div>
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-4.jpg?v=orvatio1" alt="Global Treasury">
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="about-content">
  <div class="content-title style1">
  <span>{{ pc('about','story_tagline', 'OUR CHARTER & HERITAGE') }}</span>
  <h2>{{ pc('about','story_heading', 'Engineering the Modern Standard of Private & Commercial Banking') }}</h2>
  <p>{{ pc('about','story_body') }}</p>
  </div>
  <div class="feature-item-wrap">
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-clicking"></i>
  </div>
  <div class="feature-text">
  <h3>Segregated Multi-Currency Custody</h3>
  <p>{{ pc('about','bullet_1') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-alarm"></i>
  </div>
  <div class="feature-text">
  <h3>24/7 Senior Private Bankers</h3>
  <p>{{ pc('about','bullet_2') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-setting"></i>
  </div>
  <div class="feature-text">
  <h3>Direct Interbank FX &amp; Settlement</h3>
  <p>{{ pc('about','bullet_3') }}</p>
  </div>
  </div>
  </div>
  <a href="register" class="btn style1">Open a Private Account<i class="ri-arrow-right-s-line"></i></a>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  <div class="container pb-75">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title style1">
          <span>FIDUCIARY GOVERNANCE &amp; STEWARDSHIP</span>
          <h3>Capital Architecture Built for Generational Permanence</h3>
        </div>
        <p>{{$settings->site_name}} operates as a full-reserve digital private bank and commercial treasury institution serving high-net-worth individuals, family offices, sovereign mandates, and multinational enterprises across Europe, North America, the Middle East, Africa, and Asia-Pacific. By integrating directly with SWIFT gpi, SEPA Instant, Fedwire, CHAPS, and regional RTGS clearing rails, we remove correspondent bottlenecks and opaque FX spreads.</p>
        <p>Every balance held with {{$settings->site_name}} is ring-fenced inside tier-one custodial vaults, backed by 100% liquid reserve coverage and continuous cryptographic auditability. Whether you are structuring cross-border trade letters of credit, allocating idle cash into sovereign T-bill sweeps, or drawing down a Lombard credit line against held securities, our platform executes with Swiss precision.</p>
        <p>Our private advisory principals in Zürich, London, New York, Dubai, and Singapore partner directly with your family office or CFO team—structuring bespoke multi-signatory governance, FX forward hedges, and global metal card programs tailored to your exact mandate.</p>
      </div>
    </div>
  </div>
  
  <div class="counter-wrap style1 pb-75">
  <div class="container">
  <div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-2">
  <div class="section-title style1 text-center mb-40">
  <span>INSTITUTIONAL SCALE</span>
  <h2>Global Clearing Footprint &amp; Balance Sheet Strength</h2>
  </div>
  </div>
  </div>
  <div class="counter-card-wrap">
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="1680"></span>
  <span class="target">K+</span>
  </h2>
  <p>Private &amp; Corporate Clients</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="32"></span>
  <span class="target">+</span>
  </h2>
  <p>Years of Fiduciary Heritage</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="108"></span>
  <span class="target">+</span>
  </h2>
  <p>Sovereign Clearing Corridors</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="64"></span>
  <span class="target">B+</span>
  </h2>
  <p>Annual Settled Volume ($)</p>
  </div>
  </div>
  </div>
  </div>
  </div>
  
  
  <div class="feature-wrap style1 ptb-100 bg-whisper">
  <div class="container">
  <div class="row">
  <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
  <div class="section-title style1 text-center mb-40">
  <span>THE ORVATIO ADVANTAGE</span>
  <h2>One Sovereign Ledger for Every Financial Mandate</h2>
  </div>
  </div>
  </div>
  <div class="feature-slider-one owl-carousel">
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-planet-earth"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">108+ Jurisdictions</a></h3>
  <p>Local IBAN, routing, and sort-code credentials with instant settlement across major economic hubs.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-bag-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="personal">Sub-Second Wires</a></h3>
  <p>Dispatch capital via SWIFT gpi, SEPA Instant, Fedwire, ACH, and Faster Payments from a single terminal.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-notification"></i>
  </div>
  <div class="feature-info">
  <h3><a href="contact">24/7 Private Desk</a></h3>
  <p>Direct access to dedicated relationship principals and FX execution specialists around the clock.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">Institutional FX Desk</a></h3>
  <p>Convert across 55+ currencies at wholesale interbank rates with zero hidden retail markups.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-automation"></i>
  </div>
  <div class="feature-info">
  <h3><a href="loans">Lombard &amp; Asset Credit</a></h3>
  <p>Unlock structured liquidity against cash vaults, securities, or real estate within 24 hours.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-shield"></i>
  </div>
  <div class="feature-info">
  <h3><a href="about">Ring-Fenced Custody</a></h3>
  <p>100% segregated tier-one reserves fortified by hardware passkeys and biometric verification.</p>
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
  <img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Mobile Banking">
  </div>
  </div>
  <div class="col-lg-6">
  <div class="app-content">
  <div class="content-title style1">
  <span>ORVATIO MOBILE TERMINAL</span>
  <h2>{{ pc('about','cta_heading') }}</h2>
  <p>{{ pc('about','cta_body') }}</p>
  </div>
  <h5>Trusted by Over 1.68 Million Private &amp; Corporate Clients Worldwide</h5>
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
