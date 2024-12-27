@php
    /** @var \App\Models\Game $game */
    /** @var \App\Models\User $player */
    /** @var \App\Models\Character|null $character */
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Show[] $shows */
@endphp
@php
    $user = $player;

    $s = [];
    foreach ($shows as $show){
        $display = $show->show ? 'block' :'none';
        if($show->type === 'spell' && $character->spells){
            $spell = $display;
        }else{
            $s[$show->type] = $display;
        }
    }
@endphp

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const userId = '{{ $user->id }}';
            const gameId = '{{ $game->id }}';
            const userSpells = {{ $character->spells ? 'true' : 'false' }};

            Echo.channel(`App.Models.User.${userId}`)

                .listen('ToggleCharacterSheet', (e) => {
                    console.log('ToggleCharacterSheet event received:', e);
                    const element = document.getElementById(e.sheetPart);
                    const tuttaElement = document.getElementById('tutta');

                    if (e.sheetPart === 'spell') {
                        if (userSpells) {
                            element.style.display = e.show ? 'block' : 'none';
                        }
                        tuttaElement.style.display = e.show ? 'block' : 'none';
                    } else {
                        element.style.display = e.show ? 'block' : 'none';
                    }
                })
                .error((error) => {
                    console.error(`Error subscribing to user channel: App.Models.User.${userId}`, error);
                });

            Echo.join(`App.Models.Game.${gameId}`)
                .here((users) => {
                    console.log('Users already in the channel:', users);
                })
                .joining((user) => {
                    console.log('User joined:', user);
                })
                .leaving((user) => {
                    console.log('User left:', user);
                })
                .error((error) => {
                    console.error(`Error joining game channel: App.Models.Game.${gameId}`, error);
                })
                .listen('NewMessage', (e) => {
                    console.log('NewMessage event received:', e);
                });
        });


    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{$character->name}}
                    </h2>
                </div>
                <div class="image-container bg-gray-800 shadow-xl rounded-lg mb-12 p-12 clear-both">
                    <img id="nome" src="{{ route('image.sheet.show', ['imageName' => $character->id.'.png']) }}"
                         alt="Immagine">
                    @foreach($s as $k => $v)
                        <img id="{{$k}}" src="{{ route('image.sheet.show', ['imageName' => $character->id.'.png']) }}"
                             style="display: {{$v}}" alt="{{$k}}">
                    @endforeach
                    <img id="tutta" src="{{ route('image.sheet.show', ['imageName' => $character->id.'.png']) }}"
                         alt="Immagine">

                </div>
                @if($character->spells)
                    <div class="image-container bg-gray-800 shadow-xl rounded-lg mb-12 p-12 clear-both">
                        <img id="spell" style="display: {{$spell}}"
                             src="{{ route('image.sheet.show', ['imageName' => $character->id.'s.png']) }}" alt="Spell">
                    </div>
                @endif
                <div class="clear-both"></div>
            </div>
        </div>

    </div>

</x-app-layout>
