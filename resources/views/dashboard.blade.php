@php
    $user = auth()->user();
    $isAdmin = $user->is_admin;

    if(!$isAdmin){

        redirect()->route('/');
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} @if($isAdmin)
                Admin
            @endif
        </h2>
    </x-slot>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        })

    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    @if($isAdmin)

                          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            Partite
                        </h2>
                        @if($games === null || count($games)===0)
                            Nessuna partita presente
                        @else
                            <table class="table-auto w-full mb-6 text-gray-300 dark:bg-gray-800">
                                <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="border px-4 py-2">Nome</th>
                                    <th class="border px-4 py-2">Numero di Giocatori</th>
                                    <th class="border px-4 py-2">Giocatori registrati</th>
                                    <th class="border px-4 py-2">Stato</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($games as $game)
                                    <tr class="text-center bg-gray-700 hover:bg-gray-600">
                                        <td class="border px-4 py-2">
                                            <a href="/admin/game/{{$game->id}}" class="text-red-500 underline">{{ $game->name }}</a>
                                        </td>
                                        <td class="border px-4 py-2">{{ $game->players_count }}</td>
                                        <td class="border px-4 py-2">{{ $game->players_number }}</td>
                                        <td class="border px-4 py-2"> {{ svg('fas-'.getIconStatus($game->status), 'size-5 sm:size-6', ['style'=>'color: '.getIconColor($game->status)]) }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                Nuova partita
                            </h2>

                        @endif
                        <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">
                            <form action="/admin/game/insert" method="post">

                                @csrf
                                <div class="form-group">
                                    <label for="name"
                                           class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Nome
                                        Gioco</label>
                                    <input type="text"
                                           class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                           id="name" name="name" placeholder="Inserisci il nome della partita" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="players_count"
                                           class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Numero di
                                        Giocatori</label>
                                    <input type="number"
                                           class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                           id="players_count" name="players_count"
                                           placeholder="Inserisci il numero di giocatori" required>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="state"
                                           class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Stato</label>
                                    <select id="state" name="state"
                                            class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                            required>
                                        <option value="">Seleziona uno stato</option>
                                        <option value="ongoing">In corso</option>
                                        <option value="finished">Terminata</option>
                                        <option value="suspended">Sospesa</option>
                                    </select>
                                </div>
                                <button type="submit"
                                        class="btn mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-blue-400 hover:bg-blue-300 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-500 transition duration-150 ease-in-out">
                                    Crea
                                </button>
                            </form>
                        </div>
                    @else
                        Non sei amministratore
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
