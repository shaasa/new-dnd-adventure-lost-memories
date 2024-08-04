<div class="p-6">
    <form wire:submit="send">

        <div class="mt-4">
            <x-input-label for="message" :value="__('Messaggio')"/>
            <textarea wire:model="form.message" id="message" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.message')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-primary-button>
                Invia
            </x-primary-button>
        </div>
    </form>
</div>