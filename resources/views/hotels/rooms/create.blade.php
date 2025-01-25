<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shto dhomë të re') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                        <input type="text" name="type" required value="{{ old('type') }}" placeholder="Shëno tipin e dhomës" class="form-control">
                    </div>

                    <div class="form-group w-50 mb-3">
                        <input type="number" name="guests" required value="{{ old('guests') }}" min="1" placeholder="Shëno numrin e personave" class="form-control">
                    </div>

                    <div class="form-group w-50 mb-3">
                        <input type="text" name="price" required value="{{ old('price') }}" placeholder="Shëno çmimin" class="form-control" oninput="validatePrice(this)">
                        <small class="text-danger" id="priceError" style="display:none;">Çmimi nuk mund të jetë zero ose negativ.</small>
                    </div>

                    <div class="form-group w-50 mb-3">
                        <textarea name="description" placeholder="Shëno përshkrimin" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-plus"></i> Shto</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validatePrice(input) {
            const priceError = document.getElementById('priceError');
            const value = parseFloat(input.value);

            if (isNaN(value) || value <= 0) {
                priceError.style.display = 'block';
                input.setCustomValidity('Çmimi nuk mund të jetë zero ose negativ.');
            } else {
                priceError.style.display = 'none';
                input.setCustomValidity('');
            }
        }
    </script>
</x-app-layout>