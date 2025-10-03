<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-block about">
      <h3>Over ons</h3>
      <p>Lorem ipsum dolor sit amet.</p>
    </div>

    <div class="footer-block contact">
      <a class="navbar-brand" href="/contact" title="{{ __('misc.contact_alt') }}">
        <h3>{{ __('contact.contact_title') }}</h3>
      </a>
      <p>Email: info@voorbeeld.nl - Telefoon: +31 6 12345678 - Adres: Straatnaam 12, 1234 AB, Stad</p>
    </div>

    <div class="footer-block social">
      <h3>Volg ons</h3>
      <div class="social-links">
        <a href="#" target="_blank">Facebook</a>
        <a href="#" target="_blank">Twitter</a>
        <a href="#" target="_blank">Instagram</a>
        <a href="#" target="_blank">LinkedIn</a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p> © {{ __('misc.copyright') }} Bedrijfsnaam. Alle rechten voorbehouden.</p>
  </div>
</footer>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30506707-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();
</script>

<script type="text/javascript">
  if (top.location != self.location) {
    top.location = self.location.href
  }
</script>
