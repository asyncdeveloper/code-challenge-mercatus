@extends('layouts.plain')

@section('title', 'You’re subscribed')

@section('content')

    <h1 class="text-3xl font-semibold leading-tight text-center mb-3">
        Hooray! You’re on the waitlist.
    </h1>

    <p class="text-gray-600 text-center">
        In the meantime, feel free to reach out to us anytime at:
        <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </p>

@endsection
