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

    <div class="row">
        @foreach($types as $type)
            <!-- d-flex + align-items-stretch keeps cards equal height without custom CSS -->
            <div class="col-lg-4 col-md-6 mb-3 d-flex align-items-stretch">
                <div class="card h-100 w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-3" title="{{ $type->name }}">{{ $type->name }}</h5>

                        <div class="mt-auto">
                            <form method="get"
                                  action="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/"
                                  class="d-inline">
                                <button type="submit" class="btn btn-primary btn-block"
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
