<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <h1>
        <x-slot:title>{{ __('misc.all_brands') }}</x-slot:title>
    </h1>
                    <a class="navbar-brand" href="/manage" title="{{ __('misc.contact_al') }}">
                {{ __('pages.') }}
            </a>
    {{-- === Top 10 Handleidingen (boven de merkenlijst) === --}}
@isset($top10Manuals)
<section class="mb-4" aria-labelledby="h-top10">
    <h2 id="h-top10" class="h4 mb-3">{{ __('Top 10 manuals') }}</h2>

    <ul class="list-group">
        @forelse($top10Manuals as $m)
            @php
                $brandName = $m->brand->name ?? __('Unknown brand');
                $typeName  = $m->type->name  ?? __('Unknown type');
            @endphp
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="me-2">
                    {{--  Weergave volgens opdracht: [Brand]: [Type] --}}
                    <div class="fw-semibold">{{ $brandName }}: {{ $typeName }}</div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary">{{ number_format($m->view_count) }} {{ __('views') }}</span>

                    {{-- Link naar detailpagina zodat view_count blijft tellen --}}
                    <a href="/{{ $m->brand_id }}/{{ $m->brand?->getNameUrlEncodedAttribute() }}/{{ $m->id }}/"
                       class="btn btn-sm btn-primary">
                        {{ __('Open') }}
                    </a>
                </div>
            </li>
        @empty
            <li class="list-group-item text-muted">{{ __('No data yet') }}</li>
        @endforelse
    </ul>
</section>
@endisset


    @php
        $grouped = $brands
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->groupBy(function($b){
                $first = \Illuminate\Support\Str::upper(
                    \Illuminate\Support\Str::of($b->name)->ascii()->substr(0,1)
                );
                return preg_match('/[A-Z]/', $first) ? $first : '#';
            });
        $letters  = collect(range('A','Z'));
        $hasOther = $grouped->has('#');
    @endphp

    {{-- A–Z navigatiebalk --}}
    <nav class="position-sticky top-0 bg-white border-bottom mb-3" style="z-index:20" aria-label="{{ __('Go to letter') }}">
        <ul class="d-flex flex-wrap gap-2 list-unstyled mb-0 py-2 overflow-auto">
            @foreach($letters as $L)
                <li>
                    @if($grouped->has($L))
                        <a class="btn btn-sm btn-outline-secondary" href="#letter-{{ $L }}">{{ $L }}</a>
                    @else
                        <span class="btn btn-sm btn-outline-secondary disabled" aria-disabled="true">{{ $L }}</span>
                    @endif
                </li>
            @endforeach
            @if($hasOther)
                <li><a class="btn btn-sm btn-outline-secondary" href="#letter-other">#</a></li>
            @endif
        </ul>
    </nav>

    {{-- Merken-secties per letter --}}
    @foreach($letters as $L)
        @if($grouped->has($L))
            @php
                $columns    = 3;
                $count      = $grouped[$L]->count();
                $chunkSize  = max(1, (int) ceil($count / $columns));
                $chunks     = $grouped[$L]->values()->chunk($chunkSize);
            @endphp

            <section id="letter-{{ $L }}" class="mb-4" style="scroll-margin-top:5rem" aria-labelledby="h-{{ $L }}">
                <h2 id="h-{{ $L }}" class="h4 mb-3">{{ $L }}</h2>
                <div class="container px-0">
                    <div class="row">
                        @foreach($chunks as $col)
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="d-grid gap-2">
                                    @foreach($col as $brand)
                                        <form method="get" action="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                                            <button type="submit" class="btn btn-primary w-100" aria-label="Open {{ $brand->name }}">
                                                {{ $brand->name }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    @if($hasOther)
        @php
            $columns    = 3;
            $count      = $grouped['#']->count();
            $chunkSize  = max(1, (int) ceil($count / $columns));
            $chunks     = $grouped['#']->values()->chunk($chunkSize);
        @endphp
        <section id="letter-other" class="mb-4" style="scroll-margin-top:5rem" aria-labelledby="h-other">
            <h2 id="h-other" class="h4 mb-3">#</h2>
            <div class="container px-0">
                <div class="row">
                    @foreach($chunks as $col)
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-grid gap-2">
                                @foreach($col as $brand)
                                    <form method="get" action="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                                        <button type="submit" class="btn btn-primary w-100" aria-label="Open {{ $brand->name }}">
                                            {{ $brand->name }}
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Smooth scroll --}}
    <script>
        document.addEventListener('click', function(e){
            const a = e.target.closest('a[href^="#letter-"], a[href="#letter-other"]');
            if(!a) return;
            const el = document.querySelector(a.getAttribute('href'));
            if(!el) return;
            e.preventDefault();
            el.scrollIntoView({behavior:'smooth', block:'start'});
        });
    </script>

</x-layouts.app>
