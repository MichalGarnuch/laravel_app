@csrf
<div class="grid gap-4">
    <input name="name" value="{{ old('name', $property->name ?? '') }}" class="border p-2" placeholder="Nazwa" required>
    <input name="address" value="{{ old('address', $property->address ?? '') }}" class="border p-2" placeholder="Adres" required>
    <input name="area" type="number" value="{{ old('area', $property->area ?? '') }}" class="border p-2" placeholder="Powierzchnia m²" required>
    <input name="price" type="number" step="0.01" value="{{ old('price', $property->price ?? '') }}" class="border p-2" placeholder="Cena" required>
    <textarea name="description" class="border p-2" placeholder="Opis">{{ old('description', $property->description ?? '') }}</textarea>
</div>
<div class="mt-4">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Zapisz</button>
</div>
