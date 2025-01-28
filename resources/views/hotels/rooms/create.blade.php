<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.add_new_room') }}
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

                    <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group w-50 mb-3">
                            <input type="text" name="type" required value="{{ old('type') }}" placeholder="{{ __('messages.room_type') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="number" name="guests" required value="{{ old('guests') }}" min="1" placeholder="{{ __('messages.number_of_guests') }}" class="form-control">
                        </div>

                        <div class="form-group w-50 mb-3">
                            <input type="text" name="price" required value="{{ old('price') }}" placeholder="{{ __('messages.price') }}" class="form-control" oninput="validatePrice(this)">
                            <small class="text-danger" id="priceError" style="display:none;">{{ __('messages.price_error') }}</small>
                        </div>

                        <div class="form-group w-50 mb-3">
                            <textarea name="description" placeholder="{{ __('messages.description') }}" class="form-control">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="file" name="room_photo" id="room_photo" class="form-control" accept="public/storage">
                        </div>

                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus"></i> {{ __('messages.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validatePrice(input) {
            const priceError = document.getElementById('priceError');
            const value = parseFloat(input.value);

            if (isNaN(value) || value <= 0) {
                priceError.style.display = 'block';
                input.setCustomValidity('{{ __('messages.price_error') }}');
            } else {
                priceError.style.display = 'none';
                input.setCustomValidity('');
            }
        }
    </script>
</x-app-layout>