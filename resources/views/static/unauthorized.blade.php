<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('static.parts.head')
<body class="antialiased bg-cover bg-custom-black bg-center" style="background-image: url('/bg.svg');">
@include('layouts.partials.navbar')
<div class="min-h-screen bg-custom-black flex flex-col items-center justify-center">
    <!-- User slash icon -->
    <div class="ring h-14 center ring-red-600 rounded-full w-14">
        <i class="fas fa-user-slash text-3xl text-gray-300"></i>
    </div>
    <div class="mb-4 text-sm text-gray-300">
        {{ __('You are not authorized to access this page.') }}
    </div>
    {{ $message ?? 'Please contact admin' }}
    <div class="mt-4 flex items-center justify-between">
        <a class="btn" href="{{ route('dashboard') }}">Go Back</a>
    </div>
</div>
</body>
