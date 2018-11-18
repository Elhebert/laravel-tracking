<!-- Matomo -->
<script type="text/javascript">
    var _paq = _paq || [];
     @if (!$hasCookies)
        _paq.push(["disableCookies"]);
    @endif
    _paq.push(['setDoNotTrack', {{ config('tracking.support_dnt') ? 'true' : 'false' }}]);

    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    _paq.push(['trackVisibleContentImpressions']);
    (function() {
        var u="//{{ $config['url'] }}/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', "{{ $config['id'] }}"]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->

<!-- Matomo Image Tracker-->
<img src="https://{{ $config['url'] }}/piwik.php?idsite={{ $config['id'] }}&amp;rec=1" width="0" height="0" alt="" />
<!-- End Matomo -->
