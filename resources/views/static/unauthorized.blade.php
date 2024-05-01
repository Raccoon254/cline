<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('static.parts.head')
<body class="antialiased bg-cover bg-custom-black bg-center" style="background-image: url('/bg.svg');">
@include('layouts.partials.navbar')
<div class="min-h-screen bg-custom-black flex items-center justify-center">
    <div class="mb-4 text-sm text-gray-300">
        {{ __('You are not authorized to access this page.') }}
    </div>
    {{ $message ?? 'Please contact admin' }}
    <div class="mt-4 flex items-center justify-between">
        <button>
            <a href="{{ route('dashboard') }}">Go Back</a>
        </button>
    </div>
</div>
</body>
