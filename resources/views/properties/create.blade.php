<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Nowa nieruchomość</h2></x-slot>
    <div class="p-6">
        <form method="post" action="{{ route('properties.store') }}">
            @include('properties._form', ['cancelUrl'=> route('properties.index')])
        </form>
    </div>
</x-app-layout>
