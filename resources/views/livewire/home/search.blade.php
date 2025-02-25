<div class="relative w-full sm:w-96">
    <label for="search" class="absolute left-2 top-2.5 h-4 w-4 text-muted-foreground">🔍</label>
    <input wire:model.debounce.1000ms="search" id="search" type="text" placeholder="Buscar artículos..."
        class="pl-8 pr-4 py-2 border border-gray-300 rounded-md w-full" />
</div>
