<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">{{ $property->name }}</h2></x-slot>
    <div class="p-6 space-y-2">
        <div><b>Adres:</b> {{ $property->address }}</div>
        <div><b>Powierzchnia:</b> {{ $property->area }} m²</div>
        <div><b>Cena:</b> {{ number_format($property->price,2,',',' ') }} zł</div>
        <div><b>Opis:</b> {{ $property->description }}</div>
    </div>
</x-app-layout>
