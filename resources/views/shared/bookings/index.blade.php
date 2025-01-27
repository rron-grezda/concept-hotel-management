<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rezervimet') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 pt-1">

                    @if($bookings->count() > 0)
                        <table class="table table-bordered mt-5">
                            <tr>
                                <th>#</th>
                                <th>Dhoma</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th># nr. i personave</th>
                                @if(auth()->check() && auth()->user()->hasRole('hotel-owner'))
                                <th></th>
                                @endif
                            </tr>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id}}</td>
                                <td class="w-50">
                                    <strong>{{ App\Models\Room::where('id', $booking->room_id)->first()->type }}</strong>
                                </td>
                                <td><i class="bi bi-calendar-check"></i> {{ $booking->checkin }}</td>
                                <td><i class="bi bi-calendar-x"></i> {{ $booking->checkout }}</td>
                                <td><i class="bi bi-people"></i> {{ $booking->guests }}</td>
                                @if(auth()->check() && auth()->user()->hasRole(['hotel-owner', 'admin']))
                                <td>
                                    <a href="{{ route('booking.delete', ['id' => $booking->id]) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('A jeni i sigurtë?')">
                                        <i class="bi bi-trash"></i> Fshije
                                    </a>
                                </td>
                                @endif
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
    </div>
</x-app-layout>