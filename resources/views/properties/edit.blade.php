<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Edycja: {{ $property->name }}</h2></x-slot>
    <div class="p-6">
        <form method="post" action="{{ route('properties.update',$property) }}">
            @method('put')
            @include('properties._form', ['property'=>$property])
        </form>
    </div>
</x-app-layout>
