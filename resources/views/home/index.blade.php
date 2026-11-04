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

<style>
  .orvatio-hero {
    position: relative;
    background: radial-gradient(circle at 85% 20%, rgba(217, 119, 6, 0.14) 0%, transparent 45%),
                linear-gradient(135deg, #022C22 0%, #064E3B 55%, #033528 100%);
    padding: 95px 0 110px;
    overflow: hidden;
    color: #ffffff;
  }
  .orvatio-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(251, 191, 36, 0.12) 1px, transparent 1px);
    background-size: 32px 32px;
    opacity: 0.45;
    pointer-events: none;
  }
  .orvatio-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(251, 191, 36, 0.14);
    border: 1px solid rgba(251, 191, 36, 0.42);
    color: #FBBF24;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 2.4px;
    text-transform: uppercase;
    padding: 7px 16px;
    border-radius: 50px;
    margin-bottom: 22px;
  }
  .orvatio-hero h1 {
    font-size: 56px;
    line-height: 1.12;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 22px;
  }
  .orvatio-hero h1 .gold-accent {
    color: #FBBF24;
    font-style: italic;
  }
  .orvatio-hero p.lead-copy {
    font-size: 17px;
    line-height: 1.75;
    color: rgba(255, 255, 255, 0.84);
    margin-bottom: 34px;
    max-width: 580px;
  }
  .btn-orvatio-gold {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #FBBF24 0%, #D97706 100%);
    color: #022C22 !important;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.6px;
    padding: 15px 30px;
    border-radius: 10px;
    text-decoration: none !important;
    box-shadow: 0 12px 28px rgba(217, 119, 6, 0.32);
    transition: all 0.25s ease;
  }
  .btn-orvatio-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 34px rgba(251, 191, 36, 0.42);
  }
  .btn-orvatio-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(251, 191, 36, 0.45);
    color: #ffffff !important;
    font-weight: 600;
    font-size: 14px;
    padding: 15px 26px;
    border-radius: 10px;
    text-decoration: none !important;
    transition: all 0.25s ease;
  }
  .btn-orvatio-outline:hover {
    background: rgba(251, 191, 36, 0.16);
    border-color: #FBBF24;
  }
  .hero-telemetry-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 42px;
    padding-top: 28px;
    border-top: 1px solid rgba(255, 255, 255, 0.14);
  }
  .hero-telemetry-item h4 {
    font-size: 26px;
    font-weight: 700;
    color: #FBBF24;
    margin-bottom: 4px;
    font-family: 'Cormorant Garamond', Georgia, serif;
  }
  .hero-telemetry-item span {
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.75);
    display: block;
  }
  .hero-vault-showcase {
    position: relative;
    z-index: 2;
  }
  .hero-main-photo {
    border-radius: 20px;
    overflow: hidden;
    border: 2px solid rgba(251, 191, 36, 0.38);
    box-shadow: 0 28px 60px rgba(0, 0, 0, 0.45);
  }
  .hero-main-photo img {
    width: 100%;
    height: 430px;
    object-fit: cover;
    display: block;
  }
  .hero-floating-ledger {
    background: rgba(2, 44, 34, 0.92);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(251, 191, 36, 0.45);
    border-radius: 16px;
    padding: 18px 22px;
    margin-top: -65px;
    margin-left: 24px;
    margin-right: 24px;
    position: relative;
    z-index: 3;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4);
  }
  .fx-desk-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 36px;
    margin-top: -55px;
    position: relative;
    z-index: 10;
    box-shadow: 0 22px 55px rgba(2, 44, 34, 0.10);
    border: 1px solid rgba(6, 95, 70, 0.14);
  }
  .pillar-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 34px 28px;
    height: 100%;
    border: 1px solid rgba(6, 95, 70, 0.12);
    box-shadow: 0 12px 32px rgba(2, 44, 34, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }
  .pillar-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #065F46, #D97706);
  }
  .pillar-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(6, 95, 70, 0.12);
  }
  .pillar-num {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 15px;
    font-weight: 700;
    color: #D97706;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
    display: block;
  }
  .sovereign-card-tier {
    border-radius: 20px;
    padding: 30px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(2, 44, 34, 0.22);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .tier-emerald {
    background: linear-gradient(135deg, #065F46 0%, #022C22 100%);
    border: 1px solid rgba(251, 191, 36, 0.35);
  }
  .tier-gold {
    background: linear-gradient(135deg, #78350F 0%, #B45309 50%, #451A03 100%);
    border: 1px solid rgba(251, 191, 36, 0.65);
  }
  .tier-obsidian {
    background: linear-gradient(135deg, #0F172A 0%, #022C22 100%);
    border: 1px solid rgba(16, 185, 129, 0.35);
  }
  .card-chip {
    width: 44px;
    height: 32px;
    border-radius: 6px;
    background: linear-gradient(135deg, #FDE68A 0%, #D97706 100%);
    display: inline-block;
  }
  @media (max-width: 991px) {
    .orvatio-hero h1 {
      font-size: 40px;
    }
    .fx-desk-card {
      margin-top: 30px;
      padding: 24px;
    }
  }
</style>

<!-- SOVEREIGN PRIVATE BANKING HERO -->
<section class="orvatio-hero">
  <div class="container position-relative">
    <div class="row align-items-center gx-5">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="orvatio-hero-badge">
          <i class="ri-shield-star-fill"></i>
          <span>{{ pc('home','hero_tagline') }}</span>
        </div>
        <h1>
          Sovereign Wealth <span class="gold-accent">Architecture</span> &amp; Global Treasury
        </h1>
        <p class="lead-copy">
          {{ pc('home','hero_subtext') }}
        </p>
        <div class="d-flex flex-wrap align-items-center" style="gap: 14px;">
          <a href="register" class="btn-orvatio-gold">
            <span>{{ pc('home','hero_cta_label') }}</span>
            <i class="ri-arrow-right-up-line"></i>
          </a>
          <a href="login" class="btn-orvatio-outline">
            <i class="ri-lock-password-line"></i>
            <span>Access Client Vault</span>
          </a>
        </div>

        <div class="hero-telemetry-grid">
          <div class="hero-telemetry-item">
            <h4>$48.6B+</h4>
            <span>Annual Cleared Volume</span>
          </div>
          <div class="hero-telemetry-item">
            <h4>108+</h4>
            <span>Sovereign Jurisdictions</span>
          </div>
          <div class="hero-telemetry-item">
            <h4>&lt; 8 Sec</h4>
            <span>SWIFT gpi &amp; SEPA Finality</span>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="hero-vault-showcase">
          <div class="hero-main-photo">
            <img src="temp/custom/assets/img/hero/hero-img-2.jpg?v=orvatio1" alt="{{ $settings->site_name }} Zurich Private Lounge">
          </div>
          <div class="hero-floating-ledger">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom: 1px solid rgba(255,255,255,0.12);">
              <div>
                <span style="font-size:11px; letter-spacing:1.5px; color:#FBBF24; text-transform:uppercase; font-weight:700;">LIVE MULTI-CURRENCY CUSTODY LEDGER</span>
                <h6 class="text-white mb-0 mt-1" style="font-size:15px;">{{ $settings->site_name }} Sovereign Vault</h6>
              </div>
              <span class="badge" style="background:rgba(16,185,129,0.2); color:#34D399; border:1px solid rgba(16,185,129,0.4); padding:6px 10px;">
                <i class="ri-checkbox-circle-fill"></i> 100% Segregated
              </span>
            </div>
            <div class="row text-center">
              <div class="col-4" style="border-right:1px solid rgba(255,255,255,0.1);">
                <small style="color:rgba(255,255,255,0.65); font-size:11px;">ZÜRICH (CHF)</small>
                <div class="text-white font-weight-bold mt-1" style="font-size:14.5px;">CHF 1,420,500</div>
              </div>
              <div class="col-4" style="border-right:1px solid rgba(255,255,255,0.1);">
                <small style="color:rgba(255,255,255,0.65); font-size:11px;">NEW YORK (USD)</small>
                <div class="text-white font-weight-bold mt-1" style="font-size:14.5px;">$2,890,000</div>
              </div>
              <div class="col-4">
                <small style="color:rgba(255,255,255,0.65); font-size:11px;">EUROZONE (EUR)</small>
                <div class="text-white font-weight-bold mt-1" style="font-size:14.5px;">&euro;1,150,000</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INTERACTIVE SOVEREIGN FX & WIRE SETTLEMENT DESK -->
<section class="container mb-5">
  <div class="fx-desk-card">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <span style="color:#D97706; font-weight:700; font-size:11.5px; letter-spacing:2px; text-transform:uppercase;">LIVE INTERBANK TELEMETRY</span>
        <h3 class="mt-1 mb-2" style="color:#022C22; font-family:'Cormorant Garamond', Georgia, serif; font-size:30px; font-weight:700;">
          Instant Cross-Border FX &amp; Clearing Estimator
        </h3>
        <p class="mb-0 text-muted" style="font-size:14.5px;">
          Preview real-time interbank spot execution across {{ $settings->site_name }} clearing corridors with <strong>0.00% concealed spread</strong>.
        </p>
      </div>
      <div class="col-lg-7">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="small font-weight-bold text-uppercase" style="color:#064E3B; letter-spacing:1px;">Disbursement Amount</label>
            <input type="number" id="orvatioFxAmount" class="form-control" value="50000" min="100" style="height:48px; border-radius:10px; border:1.5px solid rgba(6,95,70,0.25); font-weight:700; font-size:16px;">
          </div>
          <div class="col-md-3">
            <label class="small font-weight-bold text-uppercase" style="color:#064E3B; letter-spacing:1px;">From Corridor</label>
            <select id="orvatioFxFrom" class="form-control" style="height:48px; border-radius:10px; border:1.5px solid rgba(6,95,70,0.25); font-weight:600;">
              <option value="USD" selected>USD — US Dollar</option>
              <option value="CHF">CHF — Swiss Franc</option>
              <option value="EUR">EUR — Euro</option>
              <option value="GBP">GBP — British Pound</option>
              <option value="SGD">SGD — Singapore Dollar</option>
              <option value="AED">AED — UAE Dirham</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="small font-weight-bold text-uppercase" style="color:#064E3B; letter-spacing:1px;">To Corridor</label>
            <select id="orvatioFxTo" class="form-control" style="height:48px; border-radius:10px; border:1.5px solid rgba(6,95,70,0.25); font-weight:600;">
              <option value="CHF" selected>CHF — Swiss Franc</option>
              <option value="EUR">EUR — Euro</option>
              <option value="GBP">GBP — British Pound</option>
              <option value="USD">USD — US Dollar</option>
              <option value="SGD">SGD — Singapore Dollar</option>
              <option value="AED">AED — UAE Dirham</option>
            </select>
          </div>
          <div class="col-md-2">
            <a href="register" class="btn style1 w-100 d-flex align-items-center justify-content-center" style="height:48px; border-radius:10px; font-weight:700;">Lock Rate</a>
          </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 pt-3" style="border-top:1px dashed rgba(6,95,70,0.2); font-size:13.5px;">
          <div>
            <span class="text-muted">Converted Settlement:</span>
            <strong id="orvatioFxResult" style="color:#065F46; font-size:17px; margin-left:6px;">CHF 44,250.00</strong>
          </div>
          <div>
            <span class="badge" style="background:#FEF3C7; color:#B45309; padding:5px 10px;">Interbank Spread: 0.00%</span>
            <span class="badge ml-2" style="background:#D1FAE5; color:#065F46; padding:5px 10px;">Finality: Instant SWIFT gpi</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  var rates = { USD: 1.0, CHF: 0.885, EUR: 0.924, GBP: 0.788, SGD: 1.342, AED: 3.6725 };
  function updateFx() {
    var amtEl = document.getElementById('orvatioFxAmount');
    var fromEl = document.getElementById('orvatioFxFrom');
    var toEl = document.getElementById('orvatioFxTo');
    var resEl = document.getElementById('orvatioFxResult');
    if (!amtEl || !fromEl || !toEl || !resEl) return;
    var amt = parseFloat(amtEl.value) || 0;
    var from = fromEl.value;
    var to = toEl.value;
    var usdVal = amt / (rates[from] || 1);
    var outVal = usdVal * (rates[to] || 1);
    resEl.textContent = to + ' ' + outVal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  document.addEventListener('DOMContentLoaded', function() {
    ['orvatioFxAmount', 'orvatioFxFrom', 'orvatioFxTo'].forEach(function(id) {
      var el = document.getElementById(id);
      if (el) {
        el.addEventListener('input', updateFx);
        el.addEventListener('change', updateFx);
      }
    });
    updateFx();
  });
})();
</script>

<!-- THE THREE PILLARS OF ORVATIO HOLDERS -->
<section class="pt-60 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
        <div class="section-title style1 text-center mb-50">
          <span>INSTITUTIONAL MANDATES</span>
          <h2>Three Pillars of Sovereign Financial Stewardship</h2>
          <p class="mt-2 text-muted">Designed for principals, family offices, and global corporations requiring frictionless liquidity across jurisdictions.</p>
        </div>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="pillar-card">
          <span class="pillar-num">Pillar I &bull; Private Wealth</span>
          <h3 style="color:#022C22; font-size:24px; font-weight:700; margin-bottom:14px;">Discretionary Private Banking &amp; Custody</h3>
          <p class="text-muted mb-4">
            Hold segregated multi-currency reserves across CHF, USD, EUR, GBP, and SGD with dedicated relationship partners and sovereign-grade asset protection.
          </p>
          <ul class="list-unstyled mb-4" style="font-size:14px; color:#334155;">
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Bankruptcy-remote segregated accounts</li>
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Overnight sovereign treasury yield vaults</li>
            <li><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> 24/7 direct senior private banker line</li>
          </ul>
          <a href="personal" class="link style1 font-weight-bold">Explore Private Banking <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="pillar-card">
          <span class="pillar-num">Pillar II &bull; Commercial Treasury</span>
          <h3 style="color:#022C22; font-size:24px; font-weight:700; margin-bottom:14px;">Multinational Corporate Clearing &amp; IBANs</h3>
          <p class="text-muted mb-4">
            Operate globally with named local IBAN and routing credentials, automated supplier disbursements, and real-time multi-signatory board governance.
          </p>
          <ul class="list-unstyled mb-4" style="font-size:14px; color:#334155;">
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Named IBANs across 108 jurisdictions</li>
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> SWIFT gpi, SEPA Instant, Fedwire &amp; CHAPS</li>
            <li><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Programmable role-based wire approvals</li>
          </ul>
          <a href="business" class="link style1 font-weight-bold">Explore Corporate Treasury <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="pillar-card">
          <span class="pillar-num">Pillar III &bull; Structured Credit</span>
          <h3 style="color:#022C22; font-size:24px; font-weight:700; margin-bottom:14px;">Lombard Lending &amp; Asset-Backed Credit</h3>
          <p class="text-muted mb-4">
            Unlock immediate institutional liquidity against your custody portfolio, commercial real estate, or corporate receivables without liquidating core holdings.
          </p>
          <ul class="list-unstyled mb-4" style="font-size:14px; color:#334155;">
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> 48-hour credit committee underwriting</li>
            <li class="mb-2"><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Fixed &amp; SOFR/SARON floating facilities</li>
            <li><i class="ri-checkbox-circle-fill mr-2" style="color:#065F46;"></i> Zero prepayment or early-exit penalties</li>
          </ul>
          <a href="loans" class="link style1 font-weight-bold">Explore Credit Facilities <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- UNIFIED TREASURY ARCHITECTURE (ABOUT SECTION) -->
<section class="about-wrap style2 pb-100">
  <div class="container">
    <div class="row gx-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
        <div class="about-img-wrap">
          <img src="temp/custom/assets/img/shape-1.png?v=orvatio1" alt="Image" class="about-shape-one">
          <div class="about-img-one">
            <img src="temp/custom/assets/img/about/about-img-5.jpg?v=orvatio1" alt="Orvatio Private Advisory Boardroom">
          </div>
          <div class="about-img-two">
            <img src="temp/custom/assets/img/about/about-img-6.jpg?v=orvatio1" alt="Orvatio Executive Global Mobility">
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
          <a href="about" class="btn style1">Read The Orvatio Charter<i class="ri-arrow-right-s-line"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- THE ORVATIO ADVANTAGE -->
<div class="feature-wrap style1 pt-100 pb-75 bg-whisper">
  <div class="container">
    <div class="row">
      <div class="col-xl-7 offset-xl-2 col-lg-10 offset-lg-1 mx-auto">
        <div class="section-title style1 text-center mb-40">
          <span>THE ORVATIO STANDARD</span>
          <h2>SwissCustody Discipline Paired With Real-Time Global Settlement</h2>
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

<!-- SOVEREIGN METAL & VIRTUAL CARD COLLECTION SHOWCASE -->
<section class="ptb-100">
  <div class="container">
    <div class="row align-items-end mb-50">
      <div class="col-lg-7">
        <div class="section-title style1">
          <span>ORVATIO CARD PROGRAMS</span>
          <h2>Precision-Milled Metal &amp; Instant Virtual Cards</h2>
        </div>
      </div>
      <div class="col-lg-5 text-lg-end">
        <a href="cards" class="btn style1">Compare All Card Tiers <i class="ri-arrow-right-s-line"></i></a>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="sovereign-card-tier tier-emerald">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <span class="badge" style="background:rgba(251,191,36,0.2); color:#FBBF24; padding:6px 12px;">EMERALD RESERVE METAL</span>
              <span class="card-chip"></span>
            </div>
            <h4 class="text-white mb-1" style="font-family:'Cormorant Garamond', Georgia, serif; font-size:26px;">Orvatio Private Reserve</h4>
            <p style="color:rgba(255,255,255,0.75); font-size:14px;">18g Brushed Emerald Stainless Steel &bull; Multi-Currency Debit &amp; Credit</p>
          </div>
          <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,0.15);">
            <div class="d-flex justify-content-between small mb-2">
              <span style="color:rgba(255,255,255,0.7);">Daily Spend Limit</span>
              <strong style="color:#FBBF24;">$250,000 USD</strong>
            </div>
            <div class="d-flex justify-content-between small">
              <span style="color:rgba(255,255,255,0.7);">FX Markup</span>
              <strong class="text-white">0.00% Interbank</strong>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="sovereign-card-tier tier-gold">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <span class="badge" style="background:rgba(255,255,255,0.2); color:#FEF3C7; padding:6px 12px;">SOVEREIGN 24K GOLD</span>
              <span class="card-chip"></span>
            </div>
            <h4 class="text-white mb-1" style="font-family:'Cormorant Garamond', Georgia, serif; font-size:26px;">Orvatio Sovereign Founders</h4>
            <p style="color:rgba(255,255,255,0.82); font-size:14px;">24K Champagne Gold Inlay &bull; Unlimited Private Aviation &amp; Concierge</p>
          </div>
          <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,0.2);">
            <div class="d-flex justify-content-between small mb-2">
              <span style="color:rgba(255,255,255,0.8);">Daily Spend Limit</span>
              <strong style="color:#FDE68A;">No Preset Cap</strong>
            </div>
            <div class="d-flex justify-content-between small">
              <span style="color:rgba(255,255,255,0.8);">Global Lounge &amp; Jet</span>
              <strong class="text-white">Complimentary</strong>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="sovereign-card-tier tier-obsidian">
          <div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <span class="badge" style="background:rgba(16,185,129,0.2); color:#34D399; padding:6px 12px;">CORPORATE TREASURY</span>
              <span class="card-chip"></span>
            </div>
            <h4 class="text-white mb-1" style="font-family:'Cormorant Garamond', Georgia, serif; font-size:26px;">Orvatio Commercial Virtual</h4>
            <p style="color:rgba(255,255,255,0.75); font-size:14px;">Instant Departmental &amp; Single-Use Virtual Cards With Real-Time Caps</p>
          </div>
          <div class="mt-4 pt-3" style="border-top:1px solid rgba(255,255,255,0.15);">
            <div class="d-flex justify-content-between small mb-2">
              <span style="color:rgba(255,255,255,0.7);">Instant Provisioning</span>
              <strong style="color:#34D399;">Unlimited Cards</strong>
            </div>
            <div class="d-flex justify-content-between small">
              <span style="color:rgba(255,255,255,0.7);">ERP &amp; Ledger Sync</span>
              <strong class="text-white">Real-Time Telemetry</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHOOSE ORVATIO HOLDERS -->
<section class="wh-wrap style2 ptb-100 bg-whisper">
  <div class="container">
    <div class="row gx-5 align-items-center">
      <div class="col-lg-6 order-lg-1 order-md-2 order-2" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <div class="wh-content">
          <div class="content-title style1">
            <span>WHY PRINCIPALS CHOOSE {{$settings->site_name}}</span>
            <h2>Architectural Permanence For Private &amp; Corporate Capital</h2>
            <p>{{$settings->site_name}} pairs the balance-sheet conservatism of a Swiss private custodian with cloud-native settlement velocity—eliminating correspondent wire delays and opaque FX markups.</p>
          </div>
          <div class="feature-item-wrap">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="flaticon-tick"></i>
              </div>
              <div class="feature-text">
                <h3>Direct Interbank Spot &amp; Forward FX</h3>
                <p>Convert across 55+ sovereign currencies with locked institutional pricing and instant settlement into named accounts.</p>
              </div>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="flaticon-tick"></i>
              </div>
              <div class="feature-text">
                <h3>Dedicated Multi-Jurisdictional IBANs</h3>
                <p>Collect and disburse capital locally across Switzerland, the Eurozone, the United Kingdom, the United States, and Asia-Pacific.</p>
              </div>
            </div>
            <div class="feature-item">
              <div class="feature-icon">
                <i class="flaticon-tick"></i>
              </div>
              <div class="feature-text">
                <h3>Senior Private Wealth Partners</h3>
                <p>Every account holder is paired with seasoned relationship officers versed in cross-border trusts, corporate treasury, and Lombard credit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-lg-2 order-md-1 order-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <div class="row align-items-end">
          <div class="col-6 wh-img-wrap">
            <img src="temp/custom/assets/img/shape-2.png?v=orvatio1" alt="Image" class="wh-shape-one moveHorizontal">
            <div class="wh-img">
              <img src="temp/custom/assets/img/why-choose-us/wh-img-4.jpg?v=orvatio1" alt="Orvatio Geneva Headquarters">
            </div>
            <div class="wh-img">
              <img src="temp/custom/assets/img/why-choose-us/wh-img-5.jpg?v=orvatio1" alt="Orvatio Global Clearing">
            </div>
          </div>
          <div class="col-6 wh-img-wrap">
            <div class="wh-img">
              <img src="temp/custom/assets/img/shape-3.png?v=orvatio1" alt="Image" class="wh-shape-two bounce">
              <img src="temp/custom/assets/img/why-choose-us/wh-img-6.jpg?v=orvatio1" alt="Orvatio Executive Advisory">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INSTITUTIONAL SCALE COUNTERS -->
<div class="counter-wrap style1 pt-100 pb-75">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-10 offset-lg-2">
        <div class="section-title style1 text-center mb-40">
          <span>SOVEREIGN SCALE</span>
          <h2>Global Footprint Backed by Segregated Capital Reserves</h2>
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
          <p>Private &amp; Corporate Mandates</p>
        </div>
      </div>
      <div class="counter-card">
        <div class="counter-text">
          <h2 class="counter-num">
            <span class="odometer" data-count="{{ pc('home','counter2_num') }}"></span>
            <span class="target">+</span>
          </h2>
          <p>Years of Custody Heritage</p>
        </div>
      </div>
      <div class="counter-card">
        <div class="counter-text">
          <h2 class="counter-num">
            <span class="odometer" data-count="{{ pc('home','counter3_num') }}"></span>
            <span class="target">+</span>
          </h2>
          <p>Correspondent Clearing Nodes</p>
        </div>
      </div>
      <div class="counter-card">
        <div class="counter-text">
          <h2 class="counter-num">
            <span class="odometer" data-count="{{ pc('home','counter4_num') }}"></span>
            <span class="target">+</span>
          </h2>
          <p>Sovereign Jurisdictions</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SAFEGUARDING & CRYPTOGRAPHIC CUSTODY -->
<section class="security-wrap ptb-100 bg-whisper">
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
          <img src="temp/custom/assets/img/shape-6.png?v=orvatio1" alt="Image" class="security-shape-one">
          <img src="temp/custom/assets/img/shape-1.png?v=orvatio1" alt="Image" class="security-shape-two">
          <img src="temp/custom/assets/img/security-img-1.jpg?v=orvatio1" alt="Orvatio Sovereign Vault Security" style="border-radius:18px;">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ORVATIO MOBILE VAULT -->
<section class="app-wrap style2 ptb-100">
  <div class="container">
    <div class="row gx-5 align-items-center">
      <div class="col-lg-6">
        <div class="app-img-wrap">
          <img src="temp/custom/assets/img/shape-4.png?v=orvatio1" alt="Image" class="app-shape-one bounce">
          <img src="temp/custom/assets/img/app-screen.png?v=orvatio1" alt="Orvatio Mobile Vault App" style="border-radius:20px;">
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
              <img src="temp/custom/assets/img/about/play-store.png?v=orvatio1" alt="Google Play">
            </a>
            <a href="app">
              <img src="temp/custom/assets/img/about/app-store.png?v=orvatio1" alt="App Store">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CLIENT MANDATES / TESTIMONIALS -->
<section class="testimonial-wrap ptb-100 bg-whisper">
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
              <img src="temp/custom/assets/img/testimonials/client-1.jpg?v=orvatio1" alt="Client">
            </div>
            <div class="client-info">
              <h3>Lukas von Berg</h3>
              <span>Managing Director, Helvetia Family Office AG</span>
            </div>
          </div>
          <div class="quote-icon">
            <i class="flaticon-quotation-mark"></i>
          </div>
        </div>
        <p class="client-quote">Consolidating our Zurich and London multi-currency mandates with {{$settings->site_name}} reduced our cross-border wire settlement to seconds and saved over 165 basis points annually on institutional FX execution.</p>
      </div>
      <div class="testimonial-card style3">
        <div class="client-info-area">
          <div class="client-info-wrap">
            <div class="client-img">
              <img src="temp/custom/assets/img/testimonials/client-2.jpg?v=orvatio1" alt="Client">
            </div>
            <div class="client-info">
              <h3>Victoria Kensington</h3>
              <span>Group Treasurer, Meridian Maritime Holdings</span>
            </div>
          </div>
          <div class="quote-icon">
            <i class="flaticon-quotation-mark"></i>
          </div>
        </div>
        <p class="client-quote">Having named USD, CHF, EUR, and GBP clearing accounts on one ledger—paired with programmable virtual corporate cards for our regional directors—has transformed our global working capital governance.</p>
      </div>
      <div class="testimonial-card style3">
        <div class="client-info-area">
          <div class="client-info-wrap">
            <div class="client-img">
              <img src="temp/custom/assets/img/testimonials/client-3.jpg?v=orvatio1" alt="Client">
            </div>
            <div class="client-info">
              <h3>Dr. Julian Mercer</h3>
              <span>Principal Founder, Mercer Biotech Ventures</span>
            </div>
          </div>
          <div class="quote-icon">
            <i class="flaticon-quotation-mark"></i>
          </div>
        </div>
        <p class="client-quote">When acquiring our European laboratory campus, {{$settings->site_name}} underwrote and funded a bespoke Lombard credit facility in under 48 hours without disturbing our core equity holdings.</p>
      </div>
      <div class="testimonial-card style3">
        <div class="client-info-area">
          <div class="client-info-wrap">
            <div class="client-img">
              <img src="temp/custom/assets/img/testimonials/client-4.jpg?v=orvatio1" alt="Client">
            </div>
            <div class="client-info">
              <h3>Sébastien Moreau</h3>
              <span>Senior Partner, Moreau &amp; Associés Geneva</span>
            </div>
          </div>
          <div class="quote-icon">
            <i class="flaticon-quotation-mark"></i>
          </div>
        </div>
        <p class="client-quote">The combination of hardware-enforced multi-signatory approvals and 24/7 direct access to our senior private banker sets {{$settings->site_name}} apart from every legacy institution we have worked with.</p>
      </div>
    </div>
  </div>
</section>

<!-- BOTTOM EXECUTIVE CTA -->
<section class="cta-wrap style1 ptb-100">
  <div class="container">
    <img src="temp/custom/assets/img/cta-shape-1.png?v=orvatio1" alt="Image" class="cta-shape-one">
    <img src="temp/custom/assets/img/cta-shape-2.png?v=orvatio1" alt="Image" class="cta-shape-two">
    <div class="row">
      <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2">
        <div class="content-title style1 text-center mb-40">
          <span>ESTABLISH YOUR MANDATE</span>
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
