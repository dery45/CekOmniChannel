@extends('layouts.admin')

@section('title', 'Integrasi CekOmniChannel')
@section('content-header', 'Integrasi CekOmniChannel')

@section('content')
<div class="row">
    <!-- Instagram Card -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('images/instagram_logo.png') }}" class="card-img-top img-fluid" alt="Instagram" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">Instagram</h5>
                <p class="card-text">Integrasikan instagram anda dengan CekOmniChannel!</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>

    <!-- Facebook Marketplace Card -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('images/facebook_logo.png') }}" class="card-img-top img-fluid" alt="Facebook Marketplace" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">Facebook</h5>
                <p class="card-text">Integrasikan facebook anda dengan CekOmniChannel!</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>

    <!-- WhatsApp Card -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('images/whatsapp_logo.png') }}" class="card-img-top img-fluid" alt="WhatsApp" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">WhatsApp</h5>
                <p class="card-text">Integrasikan Whatsapp anda dengan CekOmniChannel!</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>

    <!-- Shopee Card -->
    <div class="col-md-4 mt-3">
        <div class="card">
            <img src="{{ asset('images/shopee_logo.png') }}" class="card-img-top img-fluid" alt="Shopee" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">Shopee</h5>
                <p class="card-text">Integrasikan Shopee anda dengan CekOmniChannel!</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>

    <!-- Tokopedia Card -->
    <div class="col-md-4 mt-3">
        <div class="card">
            <img src="{{ asset('images/tokopedia_logo.png') }}" class="card-img-top img-fluid" alt="Tokopedia" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">Integrasikan Tokopedia anda dengan CekOmniChannel!</h5>
                <p class="card-text">Find our products on Tokopedia.</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>

    <!-- Lazada Card -->
    <div class="col-md-4 mt-3">
        <div class="card">
            <img src="{{ asset('images/lazada_logo.png') }}" class="card-img-top img-fluid" alt="Lazada" style="width: 30%; height: auto; display: block; margin-left: auto;  margin-right: auto;">
            <div class="card-body">
                <h5 class="card-title">Lazada</h5>
                <p class="card-text">Integrasikan Lazada anda dengan CekOmniChannel!</p>
                <a href="#" class="btn btn-primary">Integrasi (coming soon)</a>
            </div>
        </div>
    </div>
</div>
@endsection
