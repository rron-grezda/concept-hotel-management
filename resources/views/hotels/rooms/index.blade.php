<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.rooms') }}
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

                    <a href="{{ route('rooms.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> {{ __('messages.add_new_room') }}</a>
                    @if($rooms->count() > 0)
                        <table class="table table-bordered mt-5">
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.type') }}</th>
                                <th>{{ __('messages.description') }}</th>
                                <th>{{ __('messages.guests') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.photo') }}</th>
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
                                </td>
                                <td width="110px">
                                    <a href="{{ route('rooms.edit', ['room' => $room->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form method="POST" action="{{ route('rooms.destroy', ['room' => $room->id]) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="alert alert-info mt-5" role="alert">
                            {{ __('messages.no_rooms') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>