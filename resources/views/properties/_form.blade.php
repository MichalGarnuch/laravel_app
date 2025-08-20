@csrf
<div class="grid gap-4">
    <input name="name" value="{{ old('name', $property->name ?? '') }}" class="border p-2" placeholder="Nazwa" required>
    @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    <input name="address" value="{{ old('address', $property->address ?? '') }}" class="border p-2" placeholder="Adres" required>
    @error('address')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    <input name="area" type="number" value="{{ old('area', $property->area ?? '') }}" class="border p-2" placeholder="Powierzchnia m²" required>
    @error('area')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    <input name="price" type="number" step="0.01" value="{{ old('price', $property->price ?? '') }}" class="border p-2" placeholder="Cena" required>
    @error('price')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    <textarea name="description" class="border p-2" placeholder="Opis">{{ old('description', $property->description ?? '') }}</textarea>
    @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
</div>
<div class="mt-6 flex items-center gap-3">
    <a href="{{$cancelUrl}}"
       class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">
        Anuluj
    </a>
    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
        Zapisz
    </button>
</div>
