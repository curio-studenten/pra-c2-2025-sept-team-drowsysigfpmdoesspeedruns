@extends('layouts.app')

@section('content')
    <h1>Top 5 Handleidingen voor {{ $brand->name }}</h1>
    <ul>
        @foreach ($manuals as $manual)
            <li>
                <a href="{{ $manual->id }}/{{ $manual->name }}/{{ $manual->id }}/">
                    {{ $manual->title }} ({{ $manual->view_count }} views)
                </a>
                ({{ $manual->view_count }} views)
            </li>
        @endforeach
    </ul>
@endsection
