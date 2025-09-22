<x-layouts.app>
    <x-slot:breadcrumb>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/"
               title="Manuals for '{{ $brand->name }}'">
               {{ $brand->name }}
            </a>
        </li>
    </x-slot:breadcrumb>

    <h1 class="mb-2">{{ $brand->name }}</h1>
    <p class="mb-4">{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

    {{-- === Top 5 manuals voor dit merk === --}}
    @isset($top5Manuals)
    <section class="mb-4" aria-labelledby="h-top5">
        <h2 id="h-top5" class="h5 mb-3">{{ __('Top 5 manuals for') }} {{ $brand->name }}</h2>
        <ul class="list-group">
            @forelse($top5Manuals as $m)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="me-2">
                        <div class="fw-semibold" title="{{ $m->name }}">{{ $m->name }}</div>
                        <div class="text-muted small">{{ $m->type->name ?? __('Unknown type') }}</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">{{ number_format($m->view_count) }} {{ __('views') }}</span>
                        <a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $m->id }}/"
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

    <div class="row">
        @foreach($types as $type)
            <div class="col-lg-4 col-md-6 mb-3 d-flex align-items-stretch">
                <div class="card h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-3" title="{{ $type->name }}">{{ $type->name }}</h5>
                        <div class="mt-auto">
                            <form method="get"
                                  action="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/"
                                  class="d-grid">
                                <button type="submit" class="btn btn-primary"
                                        aria-label="{{ __('View manuals') }} for {{ $type->name }}">
                                    {{ __('View manuals') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-layouts.app>
