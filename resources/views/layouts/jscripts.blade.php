{{-- Code for Reload the  page --}}
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });
</script>
