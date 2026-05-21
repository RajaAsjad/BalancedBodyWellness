<script>
(function() {
    function bindImagePreview(input) {
        var previewId = input.getAttribute('data-preview');
        if (!previewId) return;
        var preview = document.getElementById(previewId);
        if (!preview) return;

        var previousUrl = null;

        input.addEventListener('change', function() {
            if (previousUrl) {
                URL.revokeObjectURL(previousUrl);
                previousUrl = null;
            }
            var file = input.files && input.files[0];
            if (!file || !file.type.match(/^image\//)) {
                return;
            }
            previousUrl = URL.createObjectURL(file);
            preview.src = previousUrl;
            preview.classList.remove('is-placeholder');
        });
    }

    document.querySelectorAll('.bbw-image-input[data-preview]').forEach(bindImagePreview);
})();
</script>
