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
        // === Groeperen op eerste letter (A-Z), met accent-normalisatie ===
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

    {{-- A–Z navigatiebalk (sticky, mobiel scrollbaar) --}}
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

    {{-- Merken-secties per letter (NETJES UITGELIJNDE KOLommen) --}}
    @foreach($letters as $L)
        @if($grouped->has($L))
            @php
                $columns    = 3;                                      // aantal kolommen
                $count      = $grouped[$L]->count();
                $chunkSize  = max(1, (int) ceil($count / $columns));   // items per kolom
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
                                        <form method="get"
                                              action="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                                            <button type="submit" class="btn btn-primary w-100"
                                                    aria-label="Open {{ $brand->name }}">
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
                                    <form method="get"
                                          action="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">
                                        <button type="submit" class="btn btn-primary w-100"
                                                aria-label="Open {{ $brand->name }}">
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

    {{-- Smooth scroll voor anchor-links --}}
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
