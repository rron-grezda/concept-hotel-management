<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hotel</title>

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
                    @if ($errors->any())
                        <div class="alert alert-info mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/search" class="d-flex align-items-center justify-content-between gap-3">
                        @csrf
                        <div class="form-group w-50">
                            <input type="search" name="hotel" required value="{{ old('hotel') }}" placeholder="Sheno emrin e hotelit" class="form-control">
                        </div>
                        <div class="form-group w-25">
                            <select name="country" id="country" required class="form-select">
                                <option value="">Shteti</option>
                                @foreach(App\Models\Country::all() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group w-25">
                            <select name="city" id="city" required class="form-select">
                                <option value="">Qyteti</option>
                                @if(request()->get('country'))
                                    @foreach(App\Models\City::where('country_id', request()->get('country')) as $city)
                                    <option value="{{ $country->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Kerko</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('#country').addEventListener('change', e=>{
                let cities = '';
                let xhr = new XMLHttpRequest();

                let url = `/country/${e.target.value}/cities`;
                xhr.open("GET", url, true);
 
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for(let city of JSON.parse(this.responseText)){
                            cities += `<option value="${city.id}">${city.name}</option>`;
                        }
                        document.querySelector('#city').innerHTML = cities
                    }
                }
                xhr.send();
            })
        </script>
    </body>
</html>
