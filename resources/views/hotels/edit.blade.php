<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.update_hotel_data') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    @if ($errors->any())
                        <div class="alert alert-info mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('status'))
                        <div class="alert alert-info mt-5">
                            {{ Session::get('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('hotels.update', ['hotel' => $hotel->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group w-25 mb-3">
                            <select name="country_id" id="country" required class="form-select">
                                <option value="">{{ __('messages.country') }}</option>
                                @foreach(App\Models\Country::all() as $country)
                                    <option value="{{ $country->id }}" @if($country->id == $hotel->country_id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group w-25 mb-3">
                            <input type="hidden" id="city_id" value="{{ $hotel->city_id }}" />
                            <select name="city_id" id="city" required class="form-select">
                                <option value="">{{ __('messages.city') }}</option>
                                @if(request()->get('country'))
                                    @foreach(App\Models\City::where('country_id', request()->get('country')) as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="search" name="name" required value="{{ $hotel->name }}" placeholder="{{ __('messages.hotel_name') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <label for="stars">{{ __('messages.Stars') }}</label>
                            <input type="number" name="stars" value="{{ $hotel->stars }}" id="stars" required min="1" max="5" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="email" name="email" required value="{{ $hotel->email }}" placeholder="{{ __('messages.hotel_email') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="tel" name="phone" required value="{{ $hotel->phone }}" placeholder="{{ __('messages.contact_phone') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="text" name="address" required value="{{ $hotel->address }}" placeholder="{{ __('messages.hotel_address') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="text" name="zip" required value="{{ $hotel->zip }}" placeholder="{{ __('messages.zip_code') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="file" name="image" required class="form-control">
                            @php
                                $hotel_image_url = (str_contains($hotel->image, 'http')) ? $hotel->image : asset('storage/' .$hotel->image);
                            @endphp
                            <img src="{{ $hotel->image }}" class="mt-3" style="height: 80px !important" alt="{{ $hotel->name }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus"></i> {{ __('messages.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            let cities = '<option value="">{{ __('messages.city_select') }}</option>';
            let xhr = new XMLHttpRequest();
            const cid = document.querySelector('#country').value;
            const city_id = document.querySelector('#city_id').value;

            let url = `/country/${cid}/cities`;
            xhr.open("GET", url, true);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    for(let city of JSON.parse(this.responseText)){
                        cities += `<option value="${city.id}" ${(city_id == city['id']) ? 'selected' : ''}>${city.name}</option>`;
                    }
                    document.querySelector('#city').innerHTML = cities
                }
            }
            xhr.send();
        })

        document.querySelector('#country').addEventListener('change', e => {
            let cities = '<option value="">{{ __('Qyteti') }}</option>';
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
</x-app-layout>