@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Client Advisory & Support')


@section('content')
<div class="content-wrapper">

<div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
<div class="container">
<div class="breadcrumb-title">
	<br><br>
<h2>{{ pc('contact','header_title') }}</h2>
<p>{{ pc('contact','header_subtext') }}</p>
<ul class="breadcrumb-menu list-style">
<li><a href="/">Home </a></li>
<li>{{ pc('contact','header_title') }}</li>
</ul>
</div>
</div>
</div>


<section class="contact-us-wrap ptb-100">
<div class="container">
<div class="row justify-content-center">
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-map-pin-line"></i>
</span>
<div class="contact-info">
<h3>{{ pc('contact','location_label') }}</h3>
<p>{{ pc('contact','location_value') }}
</p>
</div>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-mail-send-line"></i>
</span>
<div class="contact-info">
<h3>{{ pc('contact','email_label') }}</h3>
{{ pc('contact','email_value') }}
</div>
</div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6">
<div class="contact-item">
<span class="contact-icon">
<i class="ri-phone-line"></i>
</span>
<div class="contact-info">
<h3>{{ pc('contact','phone_label') }}</h3>
<a href="tel:{{ pc('contact','phone_value') }}">{{ pc('contact','phone_value') }}</a>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-7">
<div class="contact-form">

<div class="section-title style1 mb-20">
<span>DIRECT INQUIRY</span>
<h3>Connect With a Relationship Officer</h3>
<p>Submit your inquiry below and a dedicated private client or corporate treasury specialist will respond promptly.</p>
</div>

<form method="POST" action="{{route('homesendcontact')}}" class="form-wrap" id="">
<div class="row">
<div class="col-md-6">
	<div>
		@if(Session::has('success'))
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-group alert-success alert-icon alert-dismissible fade show" role="alert">
					<div class="alert-group-prepend">
						<span class="alert-group-icon text-">
							<i class="far fa-thumbs-up"></i>
						</span>
					</div>
					<div class="alert-content">
						{{ Session::get('success') }}
					</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
		@endif
	</div>
<div class="form-group">
	<br>
<input type="text" name="fullname" placeholder="Full Legal Name *" class="form-control input-lg" id="name" required data-error="Please enter your full name">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
	<br>
<input type="email" name="email" id="email" class="form-control input-lg" required placeholder="Business or Personal Email *" data-error="Please enter your email">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
	<br>
<input type="text" name="phone" placeholder="Direct Telephone Number *" class="form-control input-lg" id="phone_number" required data-error="Please enter your phone number">
<div class="help-block with-errors"></div>
</div>
</div>
<div class="col-md-6">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</div>
<div class="col-md-12">
<div class="form-group v1">
	<br>
<textarea name="message" id="message" placeholder="How can our advisory or support desk assist you today?" class="form-control input-lg" cols="20" rows="5" required data-error="Please enter your message"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="form-check checkbox">
	<br>
<input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required>
<label class="form-check-label" for="gridCheck">
I acknowledge and agree to the <a class="link style1" href="terms">Terms of Custody</a> and <a class="link style1" href="privacy">Privacy &amp; Data Charter</a>
</label>
<div class="help-block with-errors gridCheck-error"></div>
</div>
</div>
<div class="col-md-12">
<button type="submit" name="submitbtn" class="btn style1">DISPATCH INQUIRY<i class="ri-arrow-right-s-line"></i></button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
<div class="clearfix"></div>
</div>
</div>
</form>

</div>
</div>
<div class="col-lg-5">
<div class="comp-map">
<img src="temp/custom/images/support.gif?v=cherry3" width="100%" alt="24/7 Client Advisory">
</div>
</div>
</div>
</div>
</section>

</div>
@endsection
