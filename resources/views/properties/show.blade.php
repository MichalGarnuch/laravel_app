<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">{{ $property->name }}</h2></x-slot>
    <div class="p-6 space-y-2">
        <div class = "flex gap-2">
            <a href = "{{route('properties.index') }}"
        class=" px-3 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">
                Powrót
            </a>
            <a href = "{{route('properties.edit', $property->id) }}"
            class=" px-3 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Edytuj
            </a>
        </div>
            <div class="space-y-2">
        <div><b>Adres:</b> {{ $property->address }}</div>
        <div><b>Powierzchnia:</b> {{ $property->area }} m²</div>
        <div><b>Cena:</b> {{ number_format($property->price,2,',',' ') }} zł</div>
        <div><b>Opis:</b> {{ $property->description }}</div>
    </div>
</x-app-layout>
