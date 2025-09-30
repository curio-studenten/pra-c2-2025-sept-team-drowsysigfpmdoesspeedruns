<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header mr-auto">
            <a class="navbar-brand" href="/" title="{{ __('misc.home_alt') }}">
                {{ __('misc.homepage_title') }}
            </a>
            <a class="navbar-brand" href="/contact" title="{{ __('misc.contact_alt') }}">
                {{ __('contact.contact_title') }}
            </a>
            <a class="navbar-brand" href="/manage" title="{{ __('misc.manage_alt') }}">
                {{ __('managementpage.title') }}
            </a>
        </div>
        <div id="navbar" class="form-inline">
            <script>
                (function () {
                    var cx = 'partner-pub-6236044096491918:8149652050';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();
            </script>
            <gcse:searchbox-only></gcse:searchbox-only>
            <div class="ml-3">
                <a href="{{ route('language.switch', 'nl') }}" class="btn btn-sm btn-outline-light">NL</a>
                <a href="{{ route('language.switch', 'en') }}" class="btn btn-sm btn-outline-light">EN</a>
            </div>
        </div>
    </div>
</nav>