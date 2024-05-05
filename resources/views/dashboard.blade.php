@php
    $user = auth()->user();
    $isAdmin = $user->is_admin;
    function getIconStatus($status): string
    {
        return match ($status) {
            'suspended' => 'pause',
            'finished' => 'stop',
            'ongoing' => 'play',
            default => 'question',
        };
    }
    function getIconColor($status): string
    {
        return match ($status) {
            'suspended' => 'orange',
            'finished' => 'red',
            'ongoing' => 'green',
            default => 'grey',
        };
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    @if($isAdmin)
                        <script>
                            <script>
                                function editGame(game) {
                                this.formData = game; //Assumendo che 'game' sia l'oggetto partita che vuoi modificare
                                this.isEdit = true;
                                this.formTitle = 'Modifica partita';
                                this.submitButtonText = 'Modifica';
                            }

                                function submitForm() {
                                //Qui invia i dati formData al server usando isEdit per decidere se eseguire un'operazione di inserimento o di modifica
                            }
                        </script>

                        </script>
                        <div x-data="{ isModalOpen: false }" x-cloak>
                            <!-- Some other HTML -->
                            <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="bg-white rounded-lg">
                                    <!-- Modal Content -->
                                    <h3>Modalità Modifica</h3>
                                    <form method="POST" action="/update-game" class="p-4">
                                        @csrf
                                        @method('PUT')

                                        <!-- Add your form fields here, for instance -->
                                        <div>
                                            <label for="name">Nome Gioco:</label>
                                            <input type="text" id="name" name="name">
                                        </div>

                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Conferma</button>
                                        <button @click="isModalOpen = false" type="button" class="px-4 py-2 bg-red-500 text-white rounded">Chiudi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                    <th class="border px-4 py-2">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($games as $game)

                                    <tr class="text-center bg-gray-700 hover:bg-gray-600">
                                        <td class="border px-4 py-2">{{ $game->name }}</td>
                                        <td class="border px-4 py-2">{{ $game->players_count }}</td>
                                        <td class="border px-4 py-2">{{ $game->players_number }}</td>
                                        <td class="border px-4 py-2"> {{ svg('fas-'.getIconStatus($game->status), 'size-5 sm:size-6', ['style'=>'color: '.getIconColor($game->status)]) }}</td>
                                        <td class="border px-4 py-2">
                                            <button @click="isModalOpen = true" class="px-4 py-2 bg-blue-500 text-white rounded">Modifica</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                Nuova partita
                            </h2>

                        @endif
                        <form method="POST" action="/game/insert" class="space-y-4 dark"  >
                            @csrf

                            <label class="dark:text-white" for="name">Nome:</label>
                            <input class="block w-full my-2 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                   type="text" id="name" name="name">

                            <label class="dark:text-white" for="players">Numero di Giocatori:</label>
                            <input class="block w-full my-2 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                   type="number" id="players_count" name="players_count">

                            <label class="dark:text-white" for="status">Stato:</label>
                            <select class="block w-full my-2 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                    id="status" name="status">
                                <option value="ongoing">In corso</option>
                                <option value="suspended">In sospeso</option>
                                <option value="finished">Conclusa</option>
                            </select>

                            <button class="px-4 py-2 bg-blue-500 text-white rounded dark:bg-gray-800" type="submit">
                                Crea
                            </button>
                        </form>
                    @else
                        Non sei amministratore
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
