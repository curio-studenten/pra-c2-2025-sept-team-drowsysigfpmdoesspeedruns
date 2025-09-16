<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->name_url_encoded ?? $brand->getNameUrlEncodedAttribute() }}/"
               title="Manuals for '{{ $brand->name }}'">
               {{ $brand->name }}
            </a>
        </li>
    </x-slot:breadcrumb>

    <h1 class="mb-2">{{ $brand->name }}</h1>
    <p class="mb-4">{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    <div class="row">
        @foreach ($manuals as $manual)
            <!-- equal-height, neatly spaced cards -->
            <div class="col-lg-4 col-md-6 mb-3 d-flex align-items-stretch">
                <div class="card h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1" title="{{ $manual->name }}">{{ $manual->name }}</h5>

                        <p class="card-text text-muted mb-3">
                            @if ($manual->locally_available)
                                {{ $manual->filesize_human_readable }}
                            @else
                                {{ __('External manual') }}
                            @endif
                        </p>

                        <div class="mt-auto">
                            @if ($manual->locally_available)
                                <form method="get"
                                      action="/{{ $brand->id }}/{{ $brand->name_url_encoded ?? $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/"
                                      class="d-inline">
                                    <button type="submit" class="btn btn-primary btn-block"
                                            role="link" aria-label="{{ __('Open') }} {{ $manual->name }}">
                                        {{ __('Open') }}
                                    </button>
                                </form>
                            @else
                                <form method="get" action="{{ $manual->url }}" target="_blank" class="d-inline">
                                    <button type="submit" class="btn btn-primary btn-block"
                                            role="link" aria-label="{{ __('Open') }} {{ $manual->name }}">
                                        {{ __('Open') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.app>
