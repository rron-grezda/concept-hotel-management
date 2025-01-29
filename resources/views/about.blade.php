<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.about') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="max-w-5xl w-50 bg-white bg-opacity-75 shadow-lg rounded-lg p-4">
            <!-- Hotel Logo -->
            <div class="text-center mb-4">
                <img src="https://logos-world.net/wp-content/uploads/2021/08/Booking-Symbol.png" alt="Logo" width="100" height="60">
            </div>

            <div class="text-center">
                <h2 class="fw-bold text-primary">{{ __('messages.welcome_message') }}</h2>
                <!-- <p class="text-muted">{{ __('messages.welcome_message') }}</p> -->
            </div>

            <hr>

            <div class="mt-4">
                <h4 class="fw-bold"><i class="bi bi-lightbulb-fill text-warning"></i> {{ __('messages.mission') }}</h4>
                <p>{{ __('messages.mission_description') }}</p>
            </div>

            <div class="mt-4">
                <h4 class="fw-bold"><i class="bi bi-envelope-at-fill text-danger"></i> {{ __('messages.contact') }}</h4>
                <!-- Email -->
                <p><i class="bi bi-envelope-fill text-primary"></i> {{__('messages.email')}} <a href="mailto:contact@hotel.com" style="text-decoration: none;">booking@hotel.com</a></p>
                <!-- Phone -->
                <p><i class="bi bi-telephone-fill text-success"></i> {{__('messages.phone')}} <a href="tel:+358452159559" style="text-decoration: none;">+358 45 215 9559</a></p>
            </div>

            <!-- Social Media Links -->
            <div class="mt-4 text-center">
                <h4 class="fw-bold">{{ __('messages.follow_us') }}</h4>
                <a href="https://instagram.com/bookingcom/" target="_blank" class="text-primary mx-2">
                    <i class="bi bi-instagram" style="font-size: 2rem;"></i>
                </a>
                <a href="https://twitter.com/bookingcom" target="_blank" class="text-info mx-2">
                    <i class="bi bi-twitter" style="font-size: 2rem;"></i>
                </a>
                <a href="https://facebook.com/bookingcom" target="_blank" class="text-primary mx-2">
                    <i class="bi bi-facebook" style="font-size: 2rem;"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
