<script>
$(document).ready(function() {
    var $pageKey = $('#faq_page_key');
    var $serviceWrap = $('#faq_service_wrap');
    var $serviceSelect = $('#faq_service_slug');
    var $locationWrap = $('#faq_location_wrap');
    var $locationSelect = $('#faq_location_slug');
    var $blogWrap = $('#faq_blog_wrap');
    var $blogSelect = $('#faq_blog_slug');

    function togglePickers() {
        var key = $pageKey.val();
        var isServiceDetail = key === 'service-detail';
        var isLocationDetail = key === 'location-detail';
        var isBlogDetail = key === 'blog-detail';

        $serviceWrap.toggle(isServiceDetail);
        $serviceSelect.prop('required', isServiceDetail);
        if (!isServiceDetail) {
            $serviceSelect.val('');
        }

        $locationWrap.toggle(isLocationDetail);
        $locationSelect.prop('required', isLocationDetail);
        if (!isLocationDetail) {
            $locationSelect.val('');
        }

        $blogWrap.toggle(isBlogDetail);
        $blogSelect.prop('required', isBlogDetail);
        if (!isBlogDetail) {
            $blogSelect.val('');
        }
    }

    $pageKey.on('change', togglePickers);
    togglePickers();
});
</script>
