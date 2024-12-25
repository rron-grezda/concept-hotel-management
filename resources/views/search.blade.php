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
                        <a href="{{ route('login') }}" class="btn btn-sm me-2 btn-outline-secondary"><i class="bi bi-box-arrow-in-right"></i> Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-person-add"></i> Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="p-5 rounded bg-light mt-5">
                <div class="container">
                    @if($hotels && $hotels->count() > 0)
                        <div class="row">
                            @foreach($hotels as $hotel)
                                <div class="col-4">
                                    <div class="card">
                                        <img src="{{ $hotel->image }}" class="card-img-top" alt="{{ $hotel->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $hotel->name }}</h5>
                                            <p class="card-text">
                                                Stars: {{ $hotel->stars }}
                                            </p>
                                            <a href="#" class="btn btn-primary">Detajet</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        Nuk u gjet asnje hotel me parametrat qe kerkuat!
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
    </body>
</html>
