@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')

@section('title', $settings->site_title)

@inject('content', 'App\Http\Controllers\FrontController')
@section('content')

  <section class="hero-wrap style2">
  <div class="container">
  <div class="hero-shape" data-speed="0.06" data-revert="true">
  <img src="temp/custom/assets/img/hero/hero-shape-4.png?v=cherry3" alt="Image" class="hero-shape-one">
  <img src="temp/custom/assets/img/hero/hero-shape-5.png?v=cherry3" alt="Image" class="hero-shape-two">
  <img src="temp/custom/assets/img/hero/hero-shape-6.png?v=cherry3" alt="Image" class="hero-shape-three">
  </div>
  <div class="row align-items-center gx-5">
  <div class="col-lg-6">
  <div class="hero-content">
  <span data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{ pc('home','hero_tagline') }}</span>
  <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">{{ pc('home','hero_heading') }}</h1>
  <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">{{ pc('home','hero_subtext') }}</p>
  <div class="hero-btn" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
  <a href="login" class="btn style1">{{ pc('home','hero_cta_label') }}<i class="ri-arrow-right-s-line"></i></a>
  <a class="play-video" data-fancybox="" href="https://www.youtube.com/watch?v=oDDbVC3Hekc">
  <span class="play-now icon">
  <i class="ri-play-fill"></i>
  </span>
  <span class="link-text">Platform Overview</span>
  </a>
  </div>
  <div class="hero-contact" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
  <div class="hero-contact-img">
  <a href="contact">
  <img src="temp/custom/assets/img/testimonials/client-1.jpg?v=cherry3" alt="Image">
  </a>
  <a href="contact">
  <img src="temp/custom/assets/img/testimonials/client-2.jpg?v=cherry3" alt="Image">
  </a>
  <a href="contact">
  <img src="temp/custom/assets/img/testimonials/client-3.jpg?v=cherry3" alt="Image">
  </a>
  </div>
  <div class="hero-contact-text">
  <p>Join over <a href="register" class="link style1">1.45M+</a> private and corporate account holders banking across 104 countries.</p>
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6">
  <div class="hero-img-wrap">
  <div class="hero-promo-text bounce">
  <span><i class="flaticon-group"></i></span>
  <h6>12.8M+ <span>Monthly Cleared Transactions</span></h6>
  </div>
  <div class="hero-img-one">
  <img src="temp/custom/assets/img/hero/hero-img-2.jpg?v=cherry3" alt="Image">
  </div>
  <div class="hero-img-two">
  <img src="temp/custom/assets/img/hero/hero-img-3.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  
  <div class="partner-wrap ptb-100">
  <div class="container">
  <div class="row">
  <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
  <div class="section-title text-center mb-40">
  <h2>Global Clearing Rails Built for Zero-Friction Settlement</h2>
  <p class="mt-2">Direct connectivity to international payment corridors, tier-one liquidity providers, and multi-currency custodial networks.</p>
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
  
  
  <section class="about-wrap style2 pb-100">
  <div class="container">
  <div class="row gx-5 align-items-center">
  <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
  <div class="about-img-wrap">
  <img src="temp/custom/assets/img/shape-1.png?v=cherry3" alt="Image" class="about-shape-one">
  <div class="about-img-one">
  <img src="temp/custom/assets/img/about/about-img-5.jpg?v=cherry3" alt="Image">
  </div>
  <div class="about-img-two">
  <img src="temp/custom/assets/img/about/about-img-6.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  </div>
  <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
  <div class="about-content">
  <div class="content-title style1">
  <span>{{ pc('home','smart_tagline') }}</span>
  <h2>{{ pc('home','smart_heading') }}</h2>
  <p>{{ pc('home','smart_body') }}</p>
  </div>
  <div class="feature-item-wrap">
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-application"></i>
  </div>
  <div class="feature-text">
  <h3>{{ pc('home','smart_feat1_title') }}</h3>
  <p>{{ pc('home','smart_feat1_body') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-speedometer"></i>
  </div>
  <div class="feature-text">
  <h3>{{ pc('home','smart_feat2_title') }}</h3>
  <p>{{ pc('home','smart_feat2_body') }}</p>
  </div>
  </div>
  </div>
  <a href="about" class="btn style1">Explore Our Institution<i class="ri-arrow-right-s-line"></i></a>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  
  <div class="feature-wrap style1 pt-100 pb-75 bg-whisper">
  <div class="container">
  <div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-1">
  <div class="section-title style1 text-center mb-40">
  <span>THE MORTIL ADVANTAGE</span>
  <h2>Engineered for Speed, Transparency, and Institutional Trust</h2>
  </div>
  </div>
  </div>
  <div class="row justify-content-center">
  <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
  <div class="feature-card style4">
  <div class="feature-icon">
  <i class="flaticon-planet-earth"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">{{ pc('home','feature1_title') }}</a></h3>
  <p>{{ pc('home','feature1_body') }}</p>
  </div>
  </div>
  </div>
  <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
  <div class="feature-card style4">
  <div class="feature-icon">
  <i class="flaticon-money-bag-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="personal">{{ pc('home','feature2_title') }}</a></h3>
  <p>{{ pc('home','feature2_body') }}</p>
  </div>
  </div>
  </div>
  <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
  <div class="feature-card style4">
  <div class="feature-icon">
  <i class="flaticon-notification"></i>
  </div>
  <div class="feature-info">
  <h3><a href="contact">{{ pc('home','feature3_title') }}</a></h3>
  <p>{{ pc('home','feature3_body') }}</p>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  
  
  <section class="wh-wrap style2 ptb-100">
  <div class="container">
  <div class="row gx-5 align-items-center">
  <div class="col-lg-6 order-lg-1 order-md-2 order-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
  <div class="wh-content">
  <div class="content-title style1">
  <span>WHY CHOOSE {{$settings->site_name}}</span>
  <h2>A Modern Financial Partner Built for Private &amp; Corporate Growth</h2>
  <p>{{$settings->site_name}} combines the safeguarding rigor of a private bank with the agility of a cloud-native treasury platform—eliminating cross-border bottlenecks and archaic banking fees.</p>
  </div>
  <div class="feature-item-wrap">
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-tick"></i>
  </div>
  <div class="feature-text">
  <h3>Direct Interbank FX Execution</h3>
  <p>Convert across 50+ major and emerging currencies with institutional liquidity and real-time rate locks.</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-tick"></i>
  </div>
  <div class="feature-text">
  <h3>Instant Settlement &amp; Local IBANs</h3>
  <p>Receive and disburse capital like a local entity across the US, UK, Eurozone, and Asia-Pacific corridors.</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-tick"></i>
  </div>
  <div class="feature-text">
  <h3>Dedicated Private Client Advisory</h3>
  <p>Work directly with seasoned relationship managers who understand complex structures, credit, and global liquidity.</p>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6 order-lg-2 order-md-1 order-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
  <div class="row align-items-end">
  <div class="col-6 wh-img-wrap">
  <img src="temp/custom/assets/img/shape-2.png?v=cherry3" alt="Image" class="wh-shape-one moveHorizontal">
  <div class="wh-img">
  <img src="temp/custom/assets/img/why-choose-us/wh-img-4.jpg?v=cherry3" alt="Image">
  </div>
  <div class="wh-img">
  <img src="temp/custom/assets/img/why-choose-us/wh-img-5.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  <div class="col-6 wh-img-wrap">
  <div class="wh-img">
  <img src="temp/custom/assets/img/shape-3.png?v=cherry3" alt="Image" class="wh-shape-two bounce">
  <img src="temp/custom/assets/img/why-choose-us/wh-img-6.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>
  
  
  <div class="counter-wrap style1 pb-75">
  <div class="container">
  <div class="row">
  <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-2">
  <div class="section-title style1 text-center mb-40">
  <span>INSTITUTIONAL SCALE</span>
  <h2>Global Reach Backed by Disciplined Capital Stewardship</h2>
  </div>
  </div>
  </div>
  <div class="counter-card-wrap">
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="{{ pc('home','counter1_num') }}"></span>
  <span class="target">K+</span>
  </h2>
  <p>Verified Account Holders</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="{{ pc('home','counter2_num') }}"></span>
  <span class="target">+</span>
  </h2>
  <p>Years of Banking Heritage</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="{{ pc('home','counter3_num') }}"></span>
  <span class="target">+</span>
  </h2>
  <p>Partner Clearing Hubs</p>
  </div>
  </div>
  <div class="counter-card">
  <div class="counter-text">
  <h2 class="counter-num">
  <span class="odometer" data-count="{{ pc('home','counter4_num') }}"></span>
  <span class="target">+</span>
  </h2>
  <p>Countries Supported</p>
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
  <span>CORE CAPABILITIES</span>
  <h2>Comprehensive Banking Solutions Built Around Your Ambition</h2>
  </div>
  </div>
  </div>
  <div class="feature-slider-one owl-carousel">
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-planet-earth"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">Multi-Currency Accounts</a></h3>
  <p>Hold, convert, and settle in over 50 currencies from a single unified ledger with local routing credentials.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-bag-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="personal">Instant Global Wires</a></h3>
  <p>Execute high-priority international wires and domestic clearing with end-to-end settlement visibility.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-notification"></i>
  </div>
  <div class="feature-info">
  <h3><a href="cards">Commercial &amp; Private Cards</a></h3>
  <p>Issue physical metal and instant virtual cards with programmable spend controls and global acceptance.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-money-1"></i>
  </div>
  <div class="feature-info">
  <h3><a href="loans">Structured Credit Lines</a></h3>
  <p>Unlock tailored personal mortgages, automotive financing, and corporate working capital with rapid underwriting.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-automation"></i>
  </div>
  <div class="feature-info">
  <h3><a href="business">Automated Treasury</a></h3>
  <p>Streamline batch vendor payouts, international payroll, and automated sweeps into high-yield liquidity vaults.</p>
  </div>
  </div>
  <div class="feature-card style6">
  <div class="feature-icon">
  <i class="flaticon-shield"></i>
  </div>
  <div class="feature-info">
  <h3><a href="about">Tier-One Safeguarding</a></h3>
  <p>Protected by hardware-grade encryption, biometric authentication, and segregated institutional custody.</p>
  </div>
  </div>
  </div>
  </div>
  </div>
  
  
  <section class="security-wrap ptb-100">
  <div class="container">
  <div class="row gx-5 align-items-center">
  <div class="col-lg-6 col-12 order-lg-1 order-2">
  <div class="security-content">
  <div class="content-title style1">
  <span>{{ pc('home','sec_tagline') }}</span>
  <h2>{{ pc('home','sec_heading') }}</h2>
  <p>{{ pc('home','sec_body') }}</p>
  </div>
  <div class="feature-item-wrap">
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-shield"></i>
  </div>
  <div class="feature-text">
  <h3>{{ pc('home','sec_feat1_title') }}</h3>
  <p>{{ pc('home','sec_feat1_body') }}</p>
  </div>
  </div>
  <div class="feature-item">
  <div class="feature-icon">
  <i class="flaticon-lock"></i>
  </div>
  <div class="feature-text">
  <h3>{{ pc('home','sec_feat2_title') }}</h3>
  <p>{{ pc('home','sec_feat2_body') }}</p>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6 col-12 order-lg-2 order-1">
  <div class="security-img-wrap">
  <img src="temp/custom/assets/img/shape-6.png?v=cherry3" alt="Image" class="security-shape-one">
  <img src="temp/custom/assets/img/shape-1.png?v=cherry3" alt="Image" class="security-shape-two">
  <img src="temp/custom/assets/img/security-img-1.jpg?v=cherry3" alt="Image">
  </div>
  </div>
  </div>
  </div>
  </section>
  
  
  <section class="app-wrap style2 ptb-100 bg-whisper">
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
  <span>{{ pc('home','app_tagline') }}</span>
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
  
  
  <section class="testimonial-wrap ptb-100">
  <div class="container">
  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
  <div class="section-title style1 text-center mb-40">
  <span>{{ pc('home','test_tagline') }}</span>
  <h2>{{ pc('home','test_heading') }}</h2>
  </div>
  </div>
  <div class="testimonial-slider-one owl-carousel">
  <div class="testimonial-card style3">
  <div class="client-info-area">
  <div class="client-info-wrap">
  <div class="client-img">
  <img src="temp/custom/assets/img/testimonials/client-3.jpg?v=cherry3" alt="Image">
  </div>
  <div class="client-info">
  <h3>Marcus Vance</h3>
  <span>Managing Partner, Vance Global Capital</span>
  </div>
  </div>
  <div class="quote-icon">
  <i class="flaticon-quotation-mark"></i>
  </div>
  </div>
  <p class="client-quote">Transitioning our cross-border treasury to {{$settings->site_name}} cut our international settlement times from three days to under ten minutes while saving over 140 basis points on FX conversions.</p>
  </div>
  <div class="testimonial-card style3">
  <div class="client-info-area">
  <div class="client-info-wrap">
  <div class="client-img">
  <img src="temp/custom/assets/img/testimonials/client-4.jpg?v=cherry3" alt="Image">
  </div>
  <div class="client-info">
  <h3>Elena Rostova</h3>
  <span>Chief Financial Officer, Aether Logistics</span>
  </div>
  </div>
  <div class="quote-icon">
  <i class="flaticon-quotation-mark"></i>
  </div>
  </div>
  <p class="client-quote">Having USD, EUR, and GBP clearing accounts under one roof—paired with programmable virtual corporate cards for our regional teams—has transformed how we manage working capital.</p>
  </div>
  <div class="testimonial-card style3">
  <div class="client-info-area">
  <div class="client-info-wrap">
  <div class="client-img">
  <img src="temp/custom/assets/img/testimonials/client-5.jpg?v=cherry3" alt="Image">
  </div>
  <div class="client-info">
  <h3>Dr. Alistair Sterling</h3>
  <span>Founder, Sterling Surgical Group</span>
  </div>
  </div>
  <div class="quote-icon">
  <i class="flaticon-quotation-mark"></i>
  </div>
  </div>
  <p class="client-quote">When we expanded our clinical facilities, {{$settings->site_name}} structured an equipment and commercial credit line in 48 hours. Their private advisory desk is genuinely unmatched.</p>
  </div>
  <div class="testimonial-card style3">
  <div class="client-info-area">
  <div class="client-info-wrap">
  <div class="client-img">
  <img src="temp/custom/assets/img/testimonials/client-1.jpg?v=cherry3" alt="Image">
  </div>
  <div class="client-info">
  <h3>claire Beaumont</h3>
  <span>Principal Architect, Atelier Beaumont</span>
  </div>
  </div>
  <div class="quote-icon">
  <i class="flaticon-quotation-mark"></i>
  </div>
  </div>
  <p class="client-quote">Whether paying suppliers in Milan or managing personal savings vaults at home, the {{$settings->site_name}} interface is effortless, transparent, and backed by real human specialists 24/7.</p>
  </div>
  <div class="testimonial-card style3">
  <div class="client-info-area">
  <div class="client-info-wrap">
  <div class="client-img">
  <img src="temp/custom/assets/img/testimonials/client-2.jpg?v=cherry3" alt="Image">
  </div>
  <div class="client-info">
  <h3>Henrik Lindqvist</h3>
  <span>Director of Treasury, Nordik Marine</span>
  </div>
  </div>
  <div class="quote-icon">
  <i class="flaticon-quotation-mark"></i>
  </div>
  </div>
  <p class="client-quote">The real-time FX telemetry and multi-signatory approval workflows give our board complete confidence over every international wire before it leaves our custody account.</p>
  </div>
  </div>
  </div>
  </section>
  
  
  <section class="cta-wrap style1 ptb-100 bg-whisper">
  <div class="container">
  <img src="temp/custom/assets/img/cta-shape-1.png?v=cherry3" alt="Image" class="cta-shape-one">
  <img src="temp/custom/assets/img/cta-shape-2.png?v=cherry3" alt="Image" class="cta-shape-two">
  <div class="row">
  <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2">
  <div class="content-title style1 text-center mb-40">
  <span>START YOUR RELATIONSHIP</span>
  <h2>{{ pc('home','cta_heading') }}</h2>
  <p class="mt-2">{{ pc('home','cta_subtext') }}</p>
  </div>
  <div class="cta-btn">
  <a href="register" class="btn style1">{{ pc('home','cta_btn1_label') }}<i class="ri-arrow-right-s-line"></i></a>
  <a href="contact" class="btn style3">{{ pc('home','cta_btn2_label') }}<i class="ri-arrow-right-s-line"></i></a>
  </div>
  </div>
  </div>
  </div>
  </section>

@endsection
