<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/"
               title="Manuals for '{{ $brand->name }}'">
               {{ $brand->name }}
            </a>
        </li>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/"
               title="Manuals for '{{ $brand->name }} {{ $type->name }}'">
               {{ $type->name }}
            </a>
        </li>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/"
               title="View manual for '{{ $brand->name }} {{ $type->name }}'">
               {{ __('View') }}
            </a>
        </li>
    </x-slot:breadcrumb>

    <h1 class="mb-3">{{ $brand->name }} - {{ $type->name }}</h1>

    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}" width="780" height="600" frameborder="0" marginheight="0" marginwidth="0">
            {{ __('Iframes are not supported') }}<br>
            <!-- Fallback green download -->
            <form action="{{ $manual->url }}" method="get" target="_blank" class="d-inline">
                <button type="submit" class="btn btn-success">
                    {{ __('Download the manual') }}
                </button>
            </form>
        </iframe>

        <!-- Centered green download under iframe -->
        <div class="mt-3 text-center">
            <form action="{{ $manual->url }}" method="get" target="_blank" class="d-inline">
                <button type="submit" class="btn btn-success">
                    {{ __('Download the manual') }}
                </button>
            </form>
        </div>
    @else
        <!-- External manual: centered green button -->
        <div class="text-center">
            <form action="{{ $manual->url }}" method="get" target="_blank" class="d-inline">
                <button type="submit" class="btn btn-success">
                    {{ __('Download the manual') }}
                </button>
            </form>
        </div>
    @endif

</x-layouts.app>
