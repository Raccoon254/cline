<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('static.parts.head')
<body class="antialiased bg-cover bg-custom-black bg-center" style="background-image: url('/bg.svg');">
@include('layouts.partials.navbar')
<section class="main flex min-h-screen items-center justify-center flex-col">

    <div
        class="flex flex-col sm:flex-row gap-4 sm:items-center dark:bg-dots-lighter h-[70vh] selection:bg-red-500 selection:text-blue-300">
        <!-- Check for login route -->
        <div class="left flex gap-4 flex-col justify-between items-start">
            <div class="text-4xl archivo">
                Welcome to Cline <br>
                We connect clients to skills, <br>
                managing projects with ease
            </div>
            <div class="flex gap-2">
                <a href="{{ route('register') }}"
                   class="btn btn-outline btn-secondary text-gray-50 normal-case ring-1">
                    Get Started
                </a>
                <a href="{{ route('about') }}"
                   class="btn btn-outline btn-ghost text-white normal-case ring-1">
                    Learn More
                </a>
            </div>


            <div class="bottom">
                We are striving to make the world a <br>
                better place and we are doing it <br>
                one project at a time
            </div>
        </div>

        <img src="work.svg" alt="hero" class="w-96">

    </div>
</section>
</body>

</html>
