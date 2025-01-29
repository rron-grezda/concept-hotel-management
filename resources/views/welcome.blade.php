<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hotel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">

        
    </head>
    <body class="antialiased">
        <div class="container my-5">
            <!-- Top Right Navigation -->
            @if (Route::has('login'))
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <!-- Language Dropdown -->
                    <div class="dropdown me-2">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('set-locale', 'sq') }}">
                                    <span class="flag-icon flag-icon-al"></span> Shqip
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('set-locale', 'en') }}">
                                    <span class="flag-icon flag-icon-gb"></span> English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('set-locale', 'fi') }}">
                                    <span class="flag-icon flag-icon-fi"></span> Suomi
                                </a>
                            </li>
                        </ul>
                    </div>

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

            <!-- Welcome Content -->
            <div class="p-5 mt-5">
                <div class="container">
                    @if ($errors->any())
                        <div class="alert alert-info mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1 class="fw-bold" style="color: #011640; text-align: center;">{{ __('messages.welcome') }}</h1>
                    <br>
                    <h2 class="text-center mb-4 fw-bold" style="color: #011640;">{{ __('messages.search_hotels') }}</h2>
                    <form action="/search" class="d-flex align-items-center justify-content-between gap-3">
                        <div class="form-group w-50">
                            <input type="search" name="hotel" required value="{{ old('hotel') }}" placeholder="{{ __('messages.enter_hotel_name') }}" class="form-control">
                        </div>
                        <div class="form-group w-25">
                            <select name="country" id="country" required class="form-select">
                                <option value="">{{ __('messages.select_country') }}</option>
                                @foreach(App\Models\Country::all() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-25">
                            <select name="city" id="city" required class="form-select">
                                <option value="">{{ __('messages.select_city') }}</option>
                                @if(request()->get('country'))
                                    @foreach(App\Models\City::where('country_id', request()->get('country'))->get() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
         
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>

        <script>
            document.querySelector('#country').addEventListener('change', e => {
            let cities = '<option value="">{{ __("messages.select_city") }}</option>';
                let xhr = new XMLHttpRequest();

                let url = `/country/${e.target.value}/cities`;
                xhr.open("GET", url, true);

                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for (let city of JSON.parse(this.responseText)) {
                            cities += `<option value="${city.id}">${city.name}</option>`;
                        }
                        document.querySelector('#city').innerHTML = cities;
                    }
                };
                xhr.send();
            });
        </script>
    </body>
</html>
