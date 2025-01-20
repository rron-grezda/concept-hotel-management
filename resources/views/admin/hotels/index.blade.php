<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hotelet') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                @if($hotels->count() > 0)
                    <table class="table table-bordered mt-5">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Stars</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>ZIP</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                        @foreach($hotels as $hotel)
                        <tr>
                            <td>{{ $hotel->id}}</td>
                            <td>
                                {{ $hotel->name}}
                                <br><br>
                                <span>Rooms: {{ $hotel->rooms()->count() }}</span>
                                @role('hotel-owner')
                                <br>
                                <a href="" style="text-decoration: none;">Menaxho dhomat</a>
                                @endrole
                            </td>
                            <td>{{ $hotel->stars}}</td>
                            <td>{{ $hotel->email}}</td>
                            <td>{{ $hotel->phone}}</td>
                            <td>{{ $hotel->address}}</td>
                            <td>{{ $hotel->zip}}</td>
                            <td>
                                @php
                                    $hotel_image_url = (str_contains($hotel->image, 'http')) ? $hotel->image : asset('storage/' .$hotel->image);
                                @endphp
                                <img src="{{ $hotel_image_url }}" style="height: 80px !important;" alt="{{ $hotel->name }}">
                            </td>
                            <td>
                                <form method="POST" action="{{ route('hotels.destroy', ['hotel' => $hotel->id]) }}">
                                    @csrf
                                    <!-- Bejme method spoofing per tu kthyer nga metoda POST ne DELETE -->
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('A jeni i sigurtë?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                @else
                    <div class="alert alert-info mt-5" role="alert">
                        Ende nuk keni bërë asnjë rezervim!
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>