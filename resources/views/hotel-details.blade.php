<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('messages.search') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>
    <body class="antialiased" style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%;">
            <div class="container my-5 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
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
                        <div class="d-flex justify-content-between align-items-start">
                            @php
                                $hotel_image_url = (str_contains($hotel->image, 'http')) ? $hotel->image : asset('storage/hotels/' .$hotel->image);
                            @endphp
                            <div class="w-25">
                                <img src="{{ $hotel_image_url }}" class="card-img-top" alt="{{ $hotel->name }}">
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
                                <h2><i class="bi bi-hash"></i> {{ __('messages.rooms') }}</h2>
                                <h1>{{ $hotel->rooms()->count() }}</h1>
                            </div>
                        </div>

                        @if (Session::has('status'))
                            <div class="alert alert-info mt-5">
                                {{ Session::get('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-warning mt-5">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($hotel->rooms()->count() > 0)
                        <table class="table table-bordered">
                            @foreach($hotel->rooms()->get() as $room)
                            <tr>
                                <td class="w-50">
                                    <strong>{{ $room->type }}</strong>
                                    <p>{{ $room->description }}</p>
                                </td>
                                <td><i class="bi bi-people"></i> {{ $room->guests }}</td>
                                <td>{{ $room->price }} EUR</td>
                                <td>
                                    @if(auth()->check())
                                    <button type="button" id="book-room-btn" room-id="{{ $room->id }}" guests="{{ $room->guests }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bookRoom">
                                        {{ __('messages.book') }}
                                    </button>
                                    @else
                                        <small class="bg-warning p-1"><i class="bi bi-info-circle"></i> {{ __('messages.login_to_book') }}</small>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                        <div class="alert alert-info mt-5" role="alert">
                            {{ __('messages.no_rooms_available', ['hotel' => $hotel->name]) }}
                        </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
        
        <!-- Rezervo dhomen -->
         <div class="modal fade" id="bookRoom" tabindex="-1" aria-labelledby="bookRoomLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="bookRoomLabel">{{ __('messages.book') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
                    </div>
                    <form method="POST" action="{{ route('book-room') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="checkin">{{ __('messages.checkin_date') }}:</label>
                                <input type="date" id="checkin" class="form-control" required name="checkin">
                            </div>
                            <div class="form-group mb-3">
                                <label for="checkout">{{ __('messages.checkout_date') }}:</label>
                                <input type="date" id="checkout" class="form-control" required name="checkout">
                            </div>
                            <div class="form-group mb-3">
                                <label for="guests">{{ __('messages.number_of_guests') }}:</label>
                                <input type="number" id="guests" value="1" class="form-control" required name="guests">
                            </div>
                            <input type="hidden" name="room_id" id="room_id" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('messages.book') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            const book_room_buttons = document.querySelectorAll('#book-room-btn')
            const guests_input = document.querySelector('#guests'); // Input-i per guests

            book_room_buttons.forEach(book_room_btn => book_room_btn.addEventListener('click', e => {
                e.preventDefault()
                document.querySelector('#room_id').value = e.target.getAttribute('room-id')
                document.querySelector('#guests').setAttribute('max', e.target.getAttribute('guests'))
            }));

            guests_input.addEventListener('input', () => {
                if (guests_input.value < 1) {
                guests_input.value = 1;
                }
            });
        </script>
    </body>
</html>