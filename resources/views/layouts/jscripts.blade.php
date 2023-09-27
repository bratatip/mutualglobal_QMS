{{-- Code for Reload the  page --}}
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });
</script>

<script>
    (function() {
        if (window.history && window.history.pushState) {
            window.history.pushState('', null, '');
            window.onpopstate = function() {
                window.history.pushState('', null, '');
            };
        }
    })();
</script>