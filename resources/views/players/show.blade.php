<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $player->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    @if(session('success'))
                        <div class="text-green-400">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('player.update', $player->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Nome</label>
                                <input type="text" name="name" value="{{ old('name', $player->name) }}"
                                    class="mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md">
                                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300">Discord ID</label>
                                <input type="text" name="discord_id" value="{{ old('discord_id', $player->discord_id) }}"
                                    class="mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md">
                                @error('discord_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300">Discord Name</label>
                                <input type="text" name="discord_name" value="{{ old('discord_name', $player->discord_name) }}"
                                    class="mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md">
                                @error('discord_name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300">Discord Private Channel ID</label>
                                <input type="text" name="discord_private_channel_id" value="{{ old('discord_private_channel_id', $player->discord_private_channel_id) }}"
                                    class="mt-1 block w-full py-2 px-3 border bg-gray-700 text-gray-300 border-gray-600 rounded-md">
                            </div>

                            <div class="flex items-center gap-3">
                                <input type="hidden" name="is_admin" value="0">
                                <input type="checkbox" name="is_admin" value="1" id="is_admin"
                                    {{ old('is_admin', $player->is_admin) ? 'checked' : '' }}
                                    class="rounded border-gray-600 bg-gray-700">
                                <label for="is_admin" class="text-sm font-medium text-gray-300">Admin</label>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-4">
                            <button type="submit"
                                class="px-5 py-2 bg-blue-400 hover:bg-blue-300 text-black font-medium rounded-md">
                                Salva
                            </button>
                            <a href="{{ url()->previous() }}"
                                class="px-5 py-2 bg-gray-600 hover:bg-gray-500 text-gray-300 font-medium rounded-md">
                                Indietro
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
