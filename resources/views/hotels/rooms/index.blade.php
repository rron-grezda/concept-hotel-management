<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dhomat') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    @if (Session::has('status'))
                        <div class="alert alert-info mt-5">
                            {{ Session::get('status') }}
                        </div>
                    @endif

                    <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Shto dhomë të re</a>
                    @if($rooms->count() > 0)
                        <table class="table table-bordered mt-5">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Guests</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th></th>
                            </tr>
                            @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->id}}</td>
                                <td>{{ $room->type}}</td>
                                <td>{{ $room->description}}</td>
                                <td>{{ $room->guests}}</td>
                                <td>{{ $room->price}}</td>
                                <td>
                                    @php
                                        $room_image_url = (str_contains($room->image, 'http')) ? $room->image : asset('storage/rooms/' .$room->image);
                                    @endphp
                                    <img src="{{ Storage::url($room->room_photo) }}" alt="Room Photo" style="width: 100px; height: auto;">
                                    <!-- <img src="{{ $room_image_url }}" style="height: 80px !important;" alt="{{ $room->name }}"> -->
                                </td>
                                <td width="110px">
                                    <a href="{{ route('rooms.edit', ['room' => $room->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('rooms.destroy', ['room' => $room->id]) }}" class="d-inline">
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
                            0 dhoma
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>