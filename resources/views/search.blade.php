<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="antialiased">
        <div class="container my-5">
            @if (Route::has('login'))
                <div class="d-flex justify-content-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-primary"><i class="bi bi-speedometer2"></i> {{ __('messages.dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm me-2 btn-primary"><i class="bi bi-box-arrow-in-right"></i> {{ __('messages.login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary"><i class="bi bi-person-add"></i> {{ __('messages.register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <section class="mt-5">
                <div class="container">
                    @if($hotels && $hotels->count() > 0)
                        <div class="row">
                            @foreach($hotels as $hotel)
                                <div class="col-3">
                                    <div class="card">
                                        @php
                                            $hotel_image_url = (str_contains($hotel->image, 'http')) ? $hotel->image : asset('storage/hotels/' .$hotel->image);
                                        @endphp
                                        <img src="{{ $hotel_image_url }}" class="card-img-top" alt="{{ $hotel->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between align-items-start">{{ $hotel->name }} <span class="badge bg-warning">{{ $hotel->stars }} <i class="bi bi-star"></i></span></h5>
                                            <p class="card-text">
                                                <i class="bi bi-buildings"></i> {{ $hotel->address}}
                                                <br/>
                                                {{ App\Models\Country::where('id', $hotel->country_id)->first()->name }},
                                                {{ $hotel->zip }}
                                                {{ App\Models\City::where('id', $hotel->city_id)->first()->name }}
                                            </p>
                                            <a href="{{ route('hotel-details', ['id' => $hotel->id]) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.more') }} <i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        {{ __('messages.no_hotels_found') }}
                        <strong><i>
                        {{ request()->get('hotel') }},
                        {{ App\Models\Country::where('id', request()->get('country'))->first()->name }},
                        {{ App\Models\City::where('id', request()->get('city'))->first()->name }}
                        </i></strong>
                    </div>
                    @endif
                </div>
            </section>
        </div>
    </body>
</html>
