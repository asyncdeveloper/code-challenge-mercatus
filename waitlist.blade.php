@extends('layouts.plain')

@section('title', 'The marketplace for verified buyers and sellers.')

@section('content')

    <h1 class="text-3xl font-semibold leading-tight text-center mb-3">
        The marketplace for <br class="hidden lg:inline">verified buyers and sellers.
    </h1>

    <p class="text-gray-600 text-center mb-10">
        Licensed agricultural or extracted products.
    </p>

    <form class="max-w-sm xl:w-5/6 mx-auto" method="POST" action="{{ route('waitlist') }}">

        @csrf

        <div class="form-group">
            <label class="form-label" for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required>

            @error('email')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-block btn-primary mb-3">
            {{ __('Request early access') }}
        </button>

        <div class="text-center">
            <small class="text-gray-600">
                Already have an account? <a class="text-primary" href="{{ route('login') }}">Log in</a>
                or <a class="text-primary" href="{{ route('register') }}">redeem your code</a>.
            </small>
        </div>

    </form>

@endsection
