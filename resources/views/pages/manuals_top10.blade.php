<x-layouts.app>

@section('content')
    <h1>Top 10 Handleidingen</h1>
    <ul>
        @foreach ($manuals as $manual)
            <li>
                {{ $manual->name }}
                {{ $manual->brand_id }}
                ({{ $manual->view_count }} views)
            </li>
        @endforeach
    </ul>
</x-layouts.app>
