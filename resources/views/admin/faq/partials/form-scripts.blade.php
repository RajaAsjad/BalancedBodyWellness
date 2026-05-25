<script>
$(document).ready(function() {
    var $pageKey = $('#faq_page_key');
    var $serviceWrap = $('#faq_service_wrap');
    var $serviceSelect = $('#faq_service_slug');

    function toggleServicePicker() {
        var isServiceDetail = $pageKey.val() === 'service-detail';
        $serviceWrap.toggle(isServiceDetail);
        $serviceSelect.prop('required', isServiceDetail);
        if (!isServiceDetail) {
            $serviceSelect.val('');
        }
    }

    $pageKey.on('change', toggleServicePicker);
    toggleServicePicker();
});
</script>
