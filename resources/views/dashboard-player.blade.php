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
            const userSpells = {{ $character->spells ? 'true' : 'false' }};
            const source = new EventSource('{{ route('board.stream', ['game' => $game->id]) }}');

            source.onmessage = function (e) {
                const shows = JSON.parse(e.data);
                shows.forEach(function (show) {
                    if (show.type === 'spell') {
                        if (userSpells) {
                            const spellEl = document.getElementById('spell');
                            if (spellEl) spellEl.style.display = show.show ? 'block' : 'none';
                        }
                        const tuttaEl = document.getElementById('tutta');
                        if (tuttaEl) tuttaEl.style.display = show.show ? 'block' : 'none';
                    } else {
                        const el = document.getElementById(show.type);
                        if (el) el.style.display = show.show ? 'block' : 'none';
                    }
                });
            };

            source.onerror = function () {
                console.warn('SSE: connessione persa, il browser ritenterà automaticamente.');
            };
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
