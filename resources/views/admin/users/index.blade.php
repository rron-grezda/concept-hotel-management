<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.users') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div style="background-image: url('https://res.klook.com/klook-hotel/image/upload/travelapi/42000000/41950000/41940400/41940388/c88a116e_z.jpg'); background-size: cover; background-position: center; min-height: 80.1vh; height: 100%;">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 pt-1">
                @if($users->count() > 0)
                    <table class="table table-bordered mt-5">
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.name_and_surname') }}</th>
                            <th>{{ __('messages.email') }}</th>
                            <th></th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>
                                <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('messages.are_you_sure') }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                @else
                    <div class="alert alert-info mt-5" role="alert">
                        {{ __('messages.no_users') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
