<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <a href="/" title="{{ __('misc.home_alt') }}" alt="{{ __('misc.home_alt') }}">
            <h1><b>{{ __('misc.homepage_title') }}</b></h1>
        </a>
        {{ $introduction_text ?? '' }}
        
        <a href="{{ route('language.switch', 'nl') }}">🇳🇱 Nederlands</a> |
        <a href="{{ route('language.switch', 'en') }}">🇬🇧 English</a>

    </div>
</div>
