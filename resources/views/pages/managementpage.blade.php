<x-layouts.app>

    <x-slot:title>
        {{ __('managementpage.title') }}
    </x-slot:title>

    <h1>{{ __('managementpage.header') }}</h1>
    
    <form action="{{ route('manual.create') }}" method="POST">
        @csrf
        <input type="text" name="brand_id" placeholder="{{ __('managementpage.brand') }}">
        <input type="text" name="name" placeholder="{{ __('managementpage.model') }}">
        <input type="submit" value="{{ __('managementpage.submit') }}">
    </form>

</x-layouts.app>