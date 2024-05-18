    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
@livewire('livewire-ui-modal')
<div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
    <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
         src="https://laravel.com/assets/img/welcome/background.svg"/>
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:justify-center lg:col-start-2">
                    <img src="{{ route('image.show', ['imageName' => 'logo_DeD.png']) }}" alt="Logo D&D">
                </div>
                @if (Route::has('login'))
                    <livewire:welcome.navigation/>
                @endif
            </header>

            <main class="mt-6">
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                    <div
                        id="docs-card"
                        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                        <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">

                            <img
                                src="{{ route('image.show', ['imageName' => 'dadiDeD2.jpg']) }}"
                                alt="Dadi D&D"
                                class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                            />
                            <div
                                class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                            ></div>
                        </div>

                        <div class="relative flex items-center gap-6 lg:items-end">
                            <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">


                                <div class="pt-3 sm:pt-5 lg:pt-0">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Benvenuti!</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Questa è l'interfaccia della nuova avventura ambientata nei Forgotten Realms.
                                        Buon divertimento
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <div
                            class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <x-fas-dice-d20 class="size-5 sm:size-6" style="color: #FF2D20"/>

                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Partite aperte</h2>
                            @if(count($totOpenGames) === 0)
                                <p class="mt-4 text-sm/relaxed">
                                    Non sono presenti partite aperte
                                </p>
                            @else
                                <div class="mt-6">
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
                                        @foreach($totOpenGames as $game)

                                            <tr class="text-center bg-gray-700 hover:bg-gray-600">
                                                <td class="border px-4 py-2">{{ $game->name }}</td>
                                                <td class="border px-4 py-2">{{ $game->players_count }}</td>
                                                <td class="border px-4 py-2">{{ $game->players_number }}</td>
                                                <td class="border px-4 py-2"> {{ svg('fas-'.getIconStatus($game->status), 'size-5 sm:size-6', ['style'=>'color: '.getIconColor($game->status)]) }}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>


                    </div>

                    <div
                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                        <div
                            class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <x-fas-people-carry-box class="size-5 sm:size-6" style="color: #FF2D20"/>

                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Istruzioni</h2>

                            <p class="mt-4 text-sm/relaxed">
                                Richiedi al master il tuo id personale e poi, entrando in una partita aperta, potrai
                                registrarti e avere accesso alla tua area riservata.
                            </p>
                        </div>


                    </div>

                    <div
                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                        <div
                            class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                            <x-fas-hand-spock class="size-5 sm:size-6" style="color: #FF2D20"/>
                        </div>

                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">Lunga vita e prosperità</h2>

                            <p class="mt-4 text-sm/relaxed">
                                Non c'entra niente con l'avventura ma mi piaceva l'icona e la volevo usare. &#128513;
                            </p>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                &copy; <a href="https://www.beatriceweb.it">BeatriceWeb </a> - Laravel
                v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</div>
</body>
</html>
