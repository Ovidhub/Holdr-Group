@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', 'About Us')

@inject('content', 'App\Http\Controllers\FrontController')
@section('content')

  <div class="content-wrapper">

  <div class="breadcrumb-wrap bg-f br-1">
  <div class="container">
  <div class="breadcrumb-title">
  <h2>{{ pc('about','header_title') }}</h2>
  <ul class="breadcrumb-menu list-style">
  <li><a href="/">Home </a></li>
  <li>{{ pc('about','header_title') }}</li>
  </ul>
  </div>
  </div>
  </div>
  
  
  <div class="partner-wrap ptb-100">
  <div class="container">
  <div class="row">
  <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
  <div class="section-title text-center mb-40">
  <h2>Built for Global Commerce, Private Wealth, and Institutional Custody</h2>
  <br>
  <h6>We pair the capital discipline and fiduciary standards of private banking with cloud-native financial technology—giving individuals, family offices, and global corporations a single, resilient home for their capital.</h6>
  </div>
  </div>
  </div>
  <div class="partner-slider owl-carousel">
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-1.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-2.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-3.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-4.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-5.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-6.png?v=cherry3" alt="Image">
  </div>
  <div class="partner-item">
  <img src="temp/custom/assets/img/partner/partner-3.png?v=cherry3" alt="Image">
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
  <img src="temp/custom/assets/img/about/about-shape-4.png?v=cherry3" alt="Image" class="about-shape-one bounce">
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-1.jpg?v=cherry3" alt="Image">
  </div>
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-2.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  <div class="col-6 about-img-wrap lgm-70">
  <img src="temp/custom/assets/img/shape-1.png?v=cherry3" alt="Image" class="about-shape-two moveHorizontal">
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-3.jpg?v=cherry3" alt="Image">
  </div>
  <div class="about-img">
  <img src="temp/custom/assets/img/about/about-img-4.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="about-content">
  <div class="content-title style1">
  <span>{{ pc('about','story_tagline') }}</span>
  <h2>{{ pc('about','story_heading') }}</h2>
  <p>{{ pc('about','story_body') }}</p>
  </div>
  <div class="feature-item-wrap">
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-clicking"></i>
  </div>
  <div class="feature-text">
  <h3>Unified Multi-Currency Custody</h3>
  <p>{{ pc('about','bullet_1') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-alarm"></i>
  </div>
  <div class="feature-text">
  <h3>Round-the-Clock Private Advisory</h3>
  <p>{{ pc('about','bullet_2') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-setting"></i>
  </div>
  <div class="feature-text">
  <h3>Zero-Markup Global Clearing</h3>
  <p>{{ pc('about','bullet_3') }}</p>
  </div>
  </div>
  </div>
  <a href="register" class="btn style1">Open an Account<i class="ri-arrow-right-s-line"></i></a>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title style1">
          <span>OUR GOVERNANCE &amp; MANDATE</span>
          <h3>Stewardship Designed for Complex Financial Lives</h3>
        </div>
        <p>{{$settings->site_name}} operates as a full-spectrum digital banking and treasury institution serving private clients, family offices, and commercial enterprises across North America, Europe, the Middle East, Africa, and Asia-Pacific. Our architecture eliminates the delays and opaque fee structures of legacy correspondent banking by connecting directly to real-time domestic and cross-border clearing rails.</p>
        <p>Every account held with {{$settings->site_name}} is underpinned by segregated tier-one liquidity management, multi-jurisdictional regulatory compliance, and continuous cryptographic auditing. Whether you are structuring cross-border trade payables, managing multi-currency liquidity reserves, or accessing bespoke credit facilities, our platform gives you institutional execution speed with complete transparency.</p>
        <p>Our private advisory teams work alongside each client to tailor account structures, foreign exchange hedging strategies, corporate card programs, and credit lines—ensuring your capital is protected, liquid, and positioned for growth in every market condition.</p>
      </div>
    </div>
  </div>
  
  <div class="counter-wrap style1 pb-75">
  <div class="container">
  <div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-2">
  <div class="section-title style1 text-center mb-40">
  <span>INSTITUTIONAL FOOTPRINT</span>
  <h2>Global Scale Backed by Disciplined Risk Governance</h2>
  </div>
  </div>
  </div>
  <div class="counter-card-wrap">
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="1450"></span>
  <span class="target">K+</span>
  </h2>
  <p>Verified Account Holders</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="28"></span>
  <span class="target">+</span>
  </h2>
  <p>Years of Banking Heritage</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="2650"></span>
  <span class="target">+</span>
  </h2>
  <p>Partner Clearing Hubs</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="48"></span>
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
  <span>CLIENT ADVANTAGES</span>
  <h2>A Unified Platform for Every Financial Requirement</h2>
  </div>
  </div>
  </div>
  <div class="feature-slider-one owl-carousel">
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-planet-earth"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">104+ Countries Covered</a></h3>
  <p>Seamless cross-border settlement and local account credentials across all major economic corridors.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-bag-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="personal">Frictionless Transfers</a></h3>
  <p>Move capital via SWIFT, SEPA Instant, ACH, Fedwire, and Faster Payments from one dashboard.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-notification"></i>
  </div>
  <div class="feature-info">
  <h3><a href="contact">24/7 Specialist Desk</a></h3>
  <p>Direct access to private banking officers and treasury specialists at any hour of the day.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">Interbank FX Rates</a></h3>
  <p>Convert currencies at institutional rates with complete fee transparency and zero hidden spreads.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-automation"></i>
  </div>
  <div class="feature-info">
  <h3><a href="loans">Real-Time Clearing</a></h3>
  <p>Automated smart-routing ensures your domestic and international instructions settle in seconds.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-shield"></i>
  </div>
  <div class="feature-info">
  <h3><a href="about">Bank-Grade Custody</a></h3>
  <p>Protected by multi-factor hardware keys, biometric verification, and segregated tier-one reserves.</p>
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
  <span>MOBILE BANKING SUITE</span>
  <h2>{{ pc('about','cta_heading') }}</h2>
  <p>{{ pc('about','cta_body') }}</p>
  </div>
  <h5>Trusted by Over 9.2 Million Clients Worldwide</h5>
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
