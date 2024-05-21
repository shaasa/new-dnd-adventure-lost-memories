@php
    $user = auth()->user();
    $isAdmin = $user->is_admin;
    $game = \App\Models\Game::findOrFail($player->game_id);

@endphp

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            Echo.channel('App.Models.Player.{{ $player->id }}')
                .listen('ToggleCharacterSheet', (e) => {
                    console.log(e);
                });

            Echo.join('App.Models.Game.{{$game->id}}')

                .error((error) => {
                    console.error(error);
                })
                .listen('NewMessage', (e) => {
                    console.log(e);
                });
        })

    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">


                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Partite
                    </h2>

                    <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
