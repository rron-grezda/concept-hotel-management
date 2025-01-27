<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Përditëso të dhënat e dhomës') }}
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

                    <form method="POST" action="{{ route('rooms.update', ['room' => $room->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group w-50 mb-3">
                            <input type="text" name="type" required value="{{ $room->type }}" placeholder="Shëno tipin e dhomës" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="number" name="guests" required value="{{ $room->guests }}" placeholder="Shëno numrin e personave" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="text" name="price" required value="{{ $room->price }}" placeholder="Shëno çmimin" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <textarea name="description" placeholder="Shëno përshkrimin" class="form-control">{{ $room->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="file" name="room_photo" id="room_photo" class="form-control" accept="public/storage">
                        </div>

                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus"></i> Përditëso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>