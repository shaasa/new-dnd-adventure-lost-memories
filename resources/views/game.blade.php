<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('game.game management') }} {{$game->name}}
        </h2>
    </x-slot>
    <script>

        document.addEventListener('DOMContentLoaded', function (callback) {

            Echo.join('App.Models.Game.{{$game->id}}')
                .here((user) => {
                    user.forEach((user) => {
                        if (!user.is_admin) {
                            const element = document.getElementById('player' + player.id);
                            if (element) {
                                element.style.color = 'green'; // cambia questo al colore che vuoi
                            }
                        }
                    })
                })
                .joining((player) => {
                    if (player.id !== 'admin') {
                        const element = document.getElementById('player' + player.id);
                        if (element) {
                            element.style.color = 'green'; // cambia questo al colore che vuoi
                        }
                    }
                })
                .leaving((player) => {
                    if (player.id !== 'admin') {
                        const element = document.getElementById('player' + player.id);
                        if (element) {
                            element.style.color = 'grey'; // cambia questo al colore che vuoi
                        }
                    }
                })
                .listen('NewMessage', (e) => {
                    console.log('NewMessage event received:', e);
                })
                .error((error) => {
                    console.error(error);
                });

        });
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ucfirst(__('game.players'))}}
                    </h2>
                    @if($players->count() === 0)
                        {{__('game.no players')}}
                    @else
                        <table class="table-auto w-full mb-6 text-gray-300 dark:bg-gray-800">
                            <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="border px-4 py-2">{{__('game.status')}}</th>
                                <th class="border px-4 py-2">{{__('game.name')}}</th>
                                <th class="border px-4 py-2">Discord id</th>
                                <th class="border px-4 py-2">{{__('game.discord name')}}</th>
                                <th class="border px-4 py-2">{{__('game.character')}}/{{__('game.class')}}/{{__('game.race')}}</th>
                                <th class="border px-4 py-2">{{__('game.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                @php
                                    $shows = \App\Models\Show::where('user_id',$player->id)->where('game_id', $game->id)->get();
                                    $s = [];
                                    foreach ($shows as $show){
                                        $color = $show->show ? ['style'=>'color:green'] :[];
                                        $s[$show->type] = $color;
                                    }
                                @endphp
                                <tr class="text-center bg-gray-700 hover:bg-gray-600">
                                    <td class="border px-4 py-2"> {{ svg('fas-circle', 'size-5 sm:size-6', ['id'=>'player'.$player->id, 'style'=>'color:grey']) }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="/admin/player/{{$player->id}}"
                                           class="text-red-500 underline">{{ $player->name }}</a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $player->discord_id }}</td>
                                    <td class="border px-4 py-2">{{ $player->discord_name }}</td>
                                    <td class="border px-4 py-2">{{ $player->characters->name }}/{{ $player->characters()->class }}/{{ $player->characters->race }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{route('player.delete', ['player' => $player->id, 'game_id'=>$game->id])}}" class="float-left"> {{ svg('fas-trash-alt', 'size-5 sm:size-6' ) }}</a>

                                        <button onclick="Livewire.dispatch('openModal', { component: 'send-discord-message', arguments: { player: {{ $player->id }} }})">{{ svg('fas-message', 'size-5 sm:size-6' ) }}</button>


                                        <a href="{{route('player.send-token', ['player' => $player->id])}}" class="float-left"> {{ svg('fas-link', 'size-5 sm:size-6 ml-4', ) }}</a>
                                        <a href="{{route('player.show', ['player' => $player->id, 'fase' => 'equipment'])}}" class="float-left"> {{ svg('phosphor-sword-bold', 'size-5 sm:size-6 ml-4', $s['equipment']) }}</a>
                                        <a href="{{route('player.show', ['player' => $player->id, 'fase' => 'characteristic'])}}" class="float-left"> {{ svg('fas-person', 'size-5 sm:size-6 ml-4',$s['characteristic'] ) }}</a>
                                        <a href="{{route('player.show', ['player' => $player->id, 'fase' => 'skill'])}}" class="float-left"> {{ svg('fas-dice-d20', 'size-5 sm:size-6 ml-4',$s['skill'] ) }}</a>
                                        <a href="{{route('player.show', ['player' => $player->id, 'fase' => 'spell'])}}" class="float-left"> {{ svg('fas-book-bookmark', 'size-5 sm:size-6 ml-4', $s['spell']) }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if($game->users->count() < $game->players_count)
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{__('game.new')}} {{__('game.player')}}
                        </h2>

                        <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">
                            <form method="POST" action="{{ route('player.game.attach') }}">
                                @csrf
                                <input type="hidden" name="game_id" value="{{$game->id}}">
                                <div class="form-group mt-4">
                                    <label for="user_id"
                                           class="block text-gray-300 dark:text-gray-500 text-sm font-medium">Stato</label>
                                    <select id="user_id" name="user_id"
                                            class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                            required>
                                        <option value="">Select a user</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}/{{$user->discord_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                        class="btn mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-blue-400 hover:bg-blue-300 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-500 transition duration-150 ease-in-out">
                                    Let's play
                                </button>
                            </form>
                            <hr>
                            <form method="POST" action="{{ route('player.store') }}">
                                @csrf
                                <input type="hidden" name="game_id" value="{{$game->id}}">
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

                                <button type="submit"
                                        class="btn mt-4 inline-flex items-center justify-center px-5 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-blue-400 hover:bg-blue-300 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-500 transition duration-150 ease-in-out">
                                    Register
                                </button>
                            </form>
                        </div>
                    @endif
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{__('game.modify')}} {{__('game.game')}}
                    </h2>


                    <div class="bg-gray-800 shadow-xl rounded-lg mt-6 p-6">
                        <form action="{{route('game.update', ['game_id'=>$game->id])}}" method="post">
                            <input type="hidden" name="id" value="{{$game->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="name"
                                       class="block text-gray-300 dark:text-gray-500 text-sm font-medium">{{ucfirst(__('game.name'))}} {{__('game.game')}}
                                </label>
                                <input type="text"
                                       class="form-control mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md"
                                       id="name" name="name" value="{{$game->name}}"
                                       placeholder="Inserisci il nome della partita" required>
                            </div>
                            <div class="form-group mt-4">
                                <label for="players_count"
                                       class="block text-gray-300 dark:text-gray-500 text-sm font-medium">{{__('game.number')}}
                                    {{__('game.players')}}</label>
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
