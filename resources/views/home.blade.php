@extends('layouts.master')

@section('content')

<section class="bg-transparent py-16 relative z-0">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-semibold mb-4">Our Services</h2>
        <p class="text-lg md:text-xl text-gray-600 mb-8">We offer a wide range of insurance services to meet your needs.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Auto Insurance</h3>
                <p class="text-gray-600">Protect your vehicle with comprehensive auto insurance coverage.</p>
            </div>
            <!-- Service Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Home Insurance</h3>
                <p class="text-gray-600">Safeguard your home and belongings with our customizable home insurance plans.</p>
            </div>
            <!-- Service Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Life Insurance</h3>
                <p class="text-gray-600">Ensure your loved ones' financial security with our life insurance options.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-transparent text-white py-16 relative z-0">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-semibold mb-4">Contact Us</h2>
        <p class="text-lg md:text-xl mb-8">Have questions or need assistance? Contact our team today.</p>
        <a href="#" class="border-2 border-white hover:bg-white hover:text-blue-500 text-xl px-8 py-3 rounded-full transition duration-300">Contact Now</a>
    </div>
</section>

@endsection