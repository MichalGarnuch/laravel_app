<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieruchomości') }}
        </h2>
    </x-slot>

    <div class="p-6">
        @if(session('ok')) <div class="mb-3 text-green-700">{{ session('ok') }}</div> @endif

        <div class="flex items-center gap-2 mb-4">
            <form method="get" class="flex gap-2">
                <input name="q" value="{{ $q }}" class="border p-2" placeholder="Szukaj nazwą/adresem">
                <button class="px-3 py-2 border">Szukaj</button>
            </form>
            <a href="{{ route('properties.create') }}" class="ml-auto px-3 py-2 bg-blue-600 text-white rounded">+ Dodaj</a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-50">
            <tr><th class="p-2 text-left">Nazwa</th><th class="p-2 text-left">Adres</th><th class="p-2">m²</th><th class="p-2">Cena</th><th class="p-2">Akcje</th></tr>
            </thead>
            <tbody>
            @forelse($props as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2">{{ $p->address }}</td>
                    <td class="p-2 text-center">{{ $p->area }}</td>
                    <td class="p-2 text-right">{{ number_format($p->price,2,',',' ') }} zł</td>
                    <td class="p-2 flex gap-2 justify-center">
                        <a href="{{ route('properties.show',$p) }}" class="underline">Podgląd</a>
                        <a href="{{ route('properties.edit',$p) }}" class="underline">Edytuj</a>
                        <form method="post" action="{{ route('properties.destroy',$p) }}" onsubmit="return confirm('Usunąć?')">
                            @csrf @method('delete')
                            <button class="text-red-600 underline">Usuń</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-4 text-center text-gray-500">Brak danych</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $props->links() }}</div>
    </div>
</x-app-layout>
