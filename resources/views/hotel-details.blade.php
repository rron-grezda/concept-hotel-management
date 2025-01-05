<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body class="antialiased">
        <div class="container my-5">
            @if (Route::has('login'))
                <div class="d-flex justify-content-end">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm me-2 btn-outline-secondary"><i class="bi bi-box-arrow-in-right"></i> Kyçu</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-person-add"></i> Regjistrohu</a>
                        @endif
                    @endauth
                </div>
            @endif

            <section class="mt-5">
                <div class="container">
                   
                    <div class="d-flex justify-content-between align-items-start">
                        @php
                            $hotel_image_url = (str_contains($hotel->image, 'http')) ? $hotel->image : asset('storage/' .$hotel->image);
                        @endphp
                        <div class="w-25">
                            <img src="{{ $hotel->image }}" class="card-img-top" alt="{{ $hotel->name }}">
                        </div>
                        <div class="w-50 mx-5">
                            <h5 class="card-title d-flex justify-content-start align-items-start">
                                <span class="badge bg-warning me-2">{{ $hotel->stars }} <i class="bi bi-star"></i></span>
                                {{ $hotel->name }}
                            </h5>
                            <p class="card-text my-4">
                                <i class="bi bi-buildings"></i> {{ $hotel->address}}
                                <br/>
                                {{ App\Models\Country::where('id', $hotel->country_id)->first()->name }},
                                {{ $hotel->zip }}
                                {{ App\Models\City::where('id', $hotel->city_id)->first()->name }}
                            </p>
                        </div>
                        <div class="">
                            <h2><i class="bi bi-hash"></i> dhoma</h2>
                            <h1>{{ $hotel->rooms()->count() }}</h1>
                        </div>
                    </div>

                    @if($hotel->rooms()->count() > 0)
                    <table class="table table-bordered">
                        @foreach($hotel->rooms()->get() as $room)
                        <tr>
                            <td>
                                <strong>{{ $room->type }}</strong>
                                <p>{{ $room->description }}</p>
                            </td>
                            <td><i class="bi bi-people"></i> {{ $room->guests }}</td>
                            <td>{{ $room->price }} EUR</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Rezervo</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <div class="alert alert-info mt-5" role="alert">
                        Hoteli "{{ $hotel->name }}" nuk ka asnje dhome te lire aktualisht!
                    </div>
                    @endif
                </div>
            </section>
        </div>
        
    </body>
</html>
