<x-app-layout>
    <div class="relative">
        <!-- Hero Section with Gallery Slider -->
        <div class="relative overflow-hidden bg-gray-900">
            <div class="swiper-container h-[600px]">
                <!-- Slider main container -->
                <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($featuredGalleries as $gallery)
                        <div class="swiper-slide">
                            <div class="relative h-[600px]">
                                <img src="{{ Storage::url('galleries/' . $gallery->image) }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center text-white max-w-4xl px-4">
                                        <h2 class="text-4xl md:text-6xl font-bold mb-4">{{ $gallery->title }}</h2>
                                        <p class="text-lg md:text-xl mb-8">{{ $gallery->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <!-- Featured Services -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Our Photography Services</h2>
                    <p class="mt-4 text-lg text-gray-500">Choose from our wide range of professional photography services</p>
                </div>

                <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($services as $service)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        @if($service->image)
                            <img class="h-48 w-full object-cover" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                        @else
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $service->name }}</h3>
                            <p class="mt-2 text-gray-500">{{ Str::limit($service->description, 100) }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-lg font-medium text-primary">${{ number_format($service->price, 2) }}</span>
                                <span class="text-sm text-gray-500">{{ $service->duration }} minutes</span>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('services.show', $service) }}"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('services.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        View All Services
                    </a>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="bg-gray-50">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">How It Works</h2>
                    <p class="mt-4 text-lg text-gray-500">Book your photography session in just a few simple steps</p>
                </div>

                <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-md bg-primary text-white flex items-center justify-center">
                            <span class="text-xl font-bold">1</span>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Choose Your Service</h3>
                        <p class="mt-2 text-base text-gray-500">Browse through our services and select the one that best fits your needs.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-md bg-primary text-white flex items-center justify-center">
                            <span class="text-xl font-bold">2</span>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Pick a Date & Time</h3>
                        <p class="mt-2 text-base text-gray-500">Select your preferred date and time for the photography session.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-md bg-primary text-white flex items-center justify-center">
                            <span class="text-xl font-bold">3</span>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Confirm & Pay</h3>
                        <p class="mt-2 text-base text-gray-500">Complete your booking by confirming the details and making the payment.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Why Choose Us</h2>
                    <p class="mt-4 text-lg text-gray-500">We're committed to providing you with the best photography experience</p>
                </div>

                <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-primary">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Professional Equipment</h3>
                        <p class="mt-2 text-base text-gray-500">We use top-of-the-line cameras and equipment for the best quality.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-primary">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Quick Turnaround</h3>
                        <p class="mt-2 text-base text-gray-500">Get your edited photos within a guaranteed timeframe.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-primary">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Experienced Team</h3>
                        <p class="mt-2 text-base text-gray-500">Our photographers have years of professional experience.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-primary">
                            <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Satisfaction Guaranteed</h3>
                        <p class="mt-2 text-base text-gray-500">We ensure you're happy with the final results.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-primary">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Ready to capture your moments?</span>
                    <span class="block text-white">Book your session today.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('services.index') }}"
                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
    }
    .swiper-pagination-bullet {
        background: white !important;
    }
    .swiper-pagination-bullet-active {
        background: white !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            loop: true,
            effect: 'fade',
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endpush 