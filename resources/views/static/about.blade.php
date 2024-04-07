<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('static.parts.head')
<body class="antialiased bg-cover bg-custom-black bg-center" style="background-image: url('/bg.svg');">
@include('layouts.partials.navbar')
<div class="min-h-screen bg-custom-black flex flex-col items-center justify-center">
    <header class=" py-8">
        <h1>
            <a href="{{ route('welcome') }}" class="text-4xl archivo">Cline</a>
        </h1>
    </header>

    <section class="py-8 ">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800">Our Mission</h2>
            <p class="mt-4 text-gray-600">At Cline, our mission is simple: Connect clients with the most talented freelancers across the globe to bring their projects to life. We believe in creating opportunities for skilled individuals while offering businesses of all sizes access to a diverse pool of talent.</p>
        </div>
    </section>

    <section class="py-8 ">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800">Why Choose Us?</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class=" p-4 shadow-lg rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">For Clients</h3>
                    <p class="mt-2 text-gray-600">Discover a world of creative talent at your fingertips. Our platform makes it easy to find and manage freelancers, ensuring your projects are completed on time and within budget.</p>
                </div>
                <div class=" p-4 shadow-lg rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">For Freelancers</h3>
                    <p class="mt-2 text-gray-600">Gain access to a wide range of projects and collaborate with clients from around the world. We offer tools and resources to help you succeed and grow your freelance business.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8 ">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800">Testimonials</h2>
            <div class="mt-4 space-y-4">
                <blockquote class=" p-4 italic text-gray-600">
                    "Using Cline has transformed the way we approach project management. Finding the right talent has never been easier." - Alex, Startup Founder
                </blockquote>
                <blockquote class=" p-4 italic text-gray-600">
                    "As a freelancer, Cline has opened up new opportunities for me. The platform is easy to use and has helped me grow my career." - Sam, Freelance Graphic Designer
                </blockquote>
            </div>
        </div>
    </section>

    <section class="py-8 ">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800">Join Our Mission</h2>
            <p class="mt-4 text-gray-600">We're more than just a platform; we're a community. Together, we can create a positive impact on the world, one project at a time. If you share our vision of a better future through collaboration and innovation, join us today.</p>
            <div class="mt-6">
                <a href="#" class="bg-green-500 text-white px-5 py-2 rounded hover:bg-green-400 transition duration-300">Get Started</a>
                <a href="#" class="ml-2 bg-transparent border border-green-500 text-green-500 px-5 py-2 rounded hover:bg-green-50 transition duration-300">Learn More</a>
            </div>
        </div>
    </section>


    <footer class=" py-4">
        <div class="max-w-6xl mx-auto px-4">
            <p class="text-gray-600 text-center">© 2024 Cline. All rights reserved.</p>
        </div>
    </footer>
</div>
</body>
</html>
