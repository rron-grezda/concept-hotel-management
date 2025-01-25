<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Përdoruesit') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                @if($users->count() > 0)
                    <table class="table table-bordered mt-5">
                        <tr>
                            <th>#</th>
                            <th>Emri dhe mbiemri</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id}}
                            <td>{{ $user->name}}
                            <td>{{ $user->email}}
                            <td>
                                <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" class="d-inline">
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
                        0 përdorues
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>