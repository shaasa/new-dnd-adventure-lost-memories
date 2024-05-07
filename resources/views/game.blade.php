<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestione partita {{$game->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Giocatori
                    </h2>
                    @if($game->players()->count() === 0)
                        Nessun giocatore ancora registrato
                    @else
                    <table class="table-auto w-full mb-6 text-gray-300 dark:bg-gray-800">
                        <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="border px-4 py-2">Nome</th>
                            <th class="border px-4 py-2">Discord id</th>
                            <th class="border px-4 py-2">Discord name</th>
                            <th class="border px-4 py-2">Character</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($game->players() as $player)
                            <tr class="text-center bg-gray-700 hover:bg-gray-600">
                                <td class="border px-4 py-2">
                                    <a href="/admin/player/{{$player->id}}"
                                       class="text-red-500 underline">{{ $player->name }}</a>
                                </td>
                                <td class="border px-4 py-2">{{ $player->discord_id }}</td>
                                <td class="border px-4 py-2">{{ $player->discord_name }}</td>
                                <td class="border px-4 py-2">{{ $player->user()->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Registra Player
                    </h2>

                    <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="discord_id" class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Discord ID</label>
                                <input type="text" class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md" id="discord_id" name="discord_id" value="{{ old('discord_id') }}" required>
                            </div>

                            <div class="form-group mt-4">
                                <label for="discord_name" class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Discord Name</label>
                                <input type="text" class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md" id="discord_name" name="discord_name" value="{{ old('discord_name') }}" required>
                            </div>

                            <div class="form-group mt-4">
                                <label for="name" class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Name</label>
                                <input type="text" class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <button type="submit" class="btn mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-blue-400 hover:bg-blue-300 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-500 transition duration-150 ease-in-out">
                                Register
                            </button>
                        </form>
                    </div>

                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Modifica partita
                    </h2>


                    <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">
                        <form action="/games/update" method="post">
                            <input type="hidden" name="id" value="{{$game->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="name"
                                       class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Nome
                                    Gioco</label>
                                <input type="text"
                                       class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                       id="name" name="name" value="{{$game->name}}"
                                       placeholder="Inserisci il nome della partita" required>
                            </div>
                            <div class="form-group mt-4">
                                <label for="players_count"
                                       class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Numero di
                                    Giocatori</label>
                                <input type="number"
                                       class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                       id="players_count" name="players_count" value="{{$game->players_count}}"
                                       placeholder="Inserisci il numero di giocatori" required>
                            </div>
                            <div class="form-group mt-4">
                                <label for="state"
                                       class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Stato</label>
                                <select id="state" name="state"
                                        class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                        required>
                                    <option value="">Seleziona uno stato</option>
                                    <option value="ongoing" @if($game->state === 'ongoing') selected @endif>In corso
                                    </option>
                                    <option value="finished" @if($game->state === 'finished') selected @endif>Terminata
                                    </option>
                                    <option value="suspended" @if($game->state === 'suspended') selected @endif>Sospesa
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                    class="btn mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-blue-400 hover:bg-blue-300 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-500 transition duration-150 ease-in-out">
                                Crea
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
