@php
    use App\Models\Game;
    use App\Models\Show;
    $user = auth()->user();
    $isAdmin = $user->is_admin;
    $game = Game::findOrFail($player->game_id);
    $shows = Show::where('user_id',$user->id)->where('game_id', $game->id)->get();
    $s = [];
    foreach ($shows as $show){
        $display = $show->show ? 'block' :'none';
        if($show->type === 'spell' && $user->spells === 1){
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

            Echo.channel('App.Models.Player.{{ $player->id }}')
                .listen('ToggleCharacterSheet', (e) => {
                    if (e.show) {
                        if (e.sheetPart === 'spell') {
                            if (1 === {{$user->spells}}) {
                                document.getElementById(e.sheetPart).style.display = 'block';
                            }
                            document.getElementById('tutta').style.display = 'block';
                        } else {
                            document.getElementById(e.sheetPart).style.display = 'block';
                        }
                    } else {
                        if (e.sheetPart === 'spell') {
                            if (1 === {{$user->spells}}) {
                                document.getElementById(e.sheetPart).style.display = 'none';
                            }
                            document.getElementById('tutta').style.display = 'none';
                        } else {
                            document.getElementById(e.sheetPart).style.display = 'none';
                        }
                    }

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
                        {{$player->user->name}}
                    </h2>
                </div>
                <div class="image-container bg-gray-800 shadow-xl rounded-lg mb-12 p-12 clear-both">
                    <img id="nome" src="{{ route('image.sheet.show', ['imageName' => $user->id.'.png']) }}"
                         alt="Immagine">
                    @foreach($s as $k => $v)
                        <img id="{{$k}}" src="{{ route('image.sheet.show', ['imageName' => $user->id.'.png']) }}"
                             style="display: {{$v}}" alt="{{$k}}">
                    @endforeach
                    <img id="tutta" src="{{ route('image.sheet.show', ['imageName' => $user->id.'.png']) }}"
                         alt="Immagine">

                </div>
                @if($user->spells)
                    <div class="image-container bg-gray-800 shadow-xl rounded-lg mb-12 p-12 clear-both">
                        <img id="spell" style="display: {{$spell}}"
                             src="{{ route('image.sheet.show', ['imageName' => $user->id.'s.png']) }}" alt="Spell">
                    </div>
                @endif
                <div class="clear-both"></div>
            </div>
        </div>

    </div>

</x-app-layout>
