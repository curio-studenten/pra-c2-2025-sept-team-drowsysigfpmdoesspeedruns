<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    {{-- 🔥 Link naar Top 10 Handleidingen --}}
    <div class="mb-4 text-center">
        <a href="{{ route('manuals.top10') }}" class="btn btn-danger btn-lg">
             Bekijk de Top 10 Handleidingen
        </a>
    </div>

    </div>

    @php
        // Group brands A, B, C... and sort alphabetically
        $grouped = $brands->sortBy('name')->groupBy(function($b){
            return strtoupper(substr($b->name, 0, 1));
        });
    @endphp

    <div class="container">
        <div class="row">
            @foreach($grouped as $letter => $group)
                <div class="col-lg-4 col-md-6 mb-4">
                    <h2 class="h4 mb-3">{{ $letter }}</h2>

                    {{-- Stack of brand buttons --}}
                    @foreach($group as $brand)
                        <form method="get"
                              action="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/"
                              class="mb-2">
                            <button type="submit" class="btn btn-primary btn-block" aria-label="Open {{ $brand->name }}">
                                {{ $brand->name }}
                            </button>
                        </form>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>
