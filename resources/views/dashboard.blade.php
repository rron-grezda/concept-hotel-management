<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                @role('admin')
                    @php
                        $users = App\Models\User::count(); 
                        $hotels = App\Models\Hotel::count();
                        $bookings = 0;
                        foreach(App\Models\User::all() as $user){
                            $bookings += $user->bookings()->count();
                        }
                    @endphp
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ $users }}</h1>
                                    <p>Users</p>
                                </div>
                            </div>        
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ $hotels }}</h1>
                                    <a href="{{ route('hotels.index') }}" style="text-decoration: none;">
                                        <p>Hotels</p>
                                    </a>
                                </div>
                            </div>        
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ $bookings }}</h1>
                                    <a href="{{ route('bookings') }}" style="text-decoration: none;">
                                        <p>Bookings</p>
                                    </a>
                                </div>
                            </div>        
                        </div>
                    </div>
                @endrole

                @role('hotel-owner')
                    @php
                        $hotels = App\Models\Hotel::where('id', auth()->id())->get()->pluck('id')->toArray();
                    @endphp
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ count($hotels) }}</h1>
                                    <a href="{{ route('hotels.index') }}" style="text-decoration: none;">
                                        <p>Hotels</p>
                                    </a>
                                </div>
                            </div>        
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1><i class="bi bi-list-ul"></i></h1>
                                    <a href="{{ route('bookings') }}" style="text-decoration: none;">
                                        <p>Bookings</p>
                                    </a>
                                </div>
                            </div>        
                        </div>
                    </div>
                @endrole

                @role('client')
                @php
                    $bookings = auth()->user()->bookings()->count();
                @endphp
                <div class="row">
                    <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>{{ $bookings }}</h1>
                                        <a href="{{ route('bookings') }}" style="text-decoration: none;">bookings</a>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>