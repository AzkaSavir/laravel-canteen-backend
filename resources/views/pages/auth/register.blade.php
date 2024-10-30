@extends('layouts.auth')

@section('title', 'Register')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Register</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Name</label>
            {{-- old name itu agar pas di enter dan pass nya salah enggak ilang --}}
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name')}}" autofocus>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" value="{{ old('email')}}" name="email">
                <div class="invalid-feedback">
                </div>
            </div>
            <label for="password" class="d-block">Password</label>
            <input id="password" 
            type="password" 
            class="form-control pwstrength @error('password') is-invalid
            @enderror" 
            data-indicator="pwindicator"
                name="password">
            @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
            <div id="pwindicator" 
                class="pwindicator">
                <div class="bar"></div>
                <div class="label"></div>
            </div>

            <label for="password2" class="d-block">Password Confirmation</label>
            <input id="password2" type="password" class="form-control" name="password_confirmation ">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
