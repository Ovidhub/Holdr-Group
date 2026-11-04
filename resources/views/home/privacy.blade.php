@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@section('title', 'Privacy & Data Charter')

@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
<br><br>
<h2>Privacy &amp; Data Protection Charter</h2>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>Privacy &amp; Data Charter</li>
</ul>
</div>
</div>
</div>

<div class="feature-wrap style1 pt-100 pb-75">
<div class="container">
<div class="row">
<div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
<div class="section-title style1 text-center mb-40">
<span style="text-transform: uppercase;">{{$settings->site_name}} PRIVACY GOVERNANCE</span>
<h4>Institutional standards for protecting client confidentiality, financial records, and digital identity.</h4>
</div>
</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="single-terms">
			@if(isset($terms) && !empty($terms->description))
				{!! $terms->description !!}
			@endif
			<h3>Cryptographic Security &amp; Regulatory Confidentiality</h3>
			<p>{{$settings->site_name}} enforces strict data minimization, hardware-backed encryption at rest and in transit, and role-segregated access controls across every jurisdiction in which we operate.</p>
			<ul class="content-feature-list list-style">
				<li><i class="ri-checkbox-multiple-line"></i><strong>Zero Commercial Data Sharing:</strong> We never sell, lease, or broker personal or corporate financial records to marketing networks or external third parties.</li>
				<li><i class="ri-checkbox-multiple-line"></i><strong>End-to-End TLS 1.3 &amp; Hardware Vaults:</strong> All client sessions, wire instructions, and API webhooks are authenticated using cryptographic signatures and multi-factor verification.</li>
				<li><i class="ri-checkbox-multiple-line"></i><strong>Client Access &amp; Portability Rights:</strong> Account holders may request certified audit exports or statutory data disclosures at any time through their dedicated relationship officer or by contacting {{ pc('contact','email_value') }}.</li>
			</ul>
			</div>
		</div>
	</div>
</div>
</div>
</div>

</div>
@endsection
