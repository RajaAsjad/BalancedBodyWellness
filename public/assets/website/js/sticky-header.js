$(function () {
    var $header = $(".site-header");
    if (!$header.length) {
        return;
    }

    var $bar = $header.find(".site-header__bar");
    var threshold = 32;

    var applied = false;

    function setPadding(h) {
        $("body").css("padding-top", applied ? h : 0);
    }

    function clearBarAnimation() {
        $header.removeClass("is-sticky-animating");
        $bar.off("animationend.pnsHeader webkitAnimationEnd.pnsHeader");
    }

    function update() {
        var scrollTop = $(window).scrollTop();
        var h = $header.outerHeight();

        if (scrollTop > threshold) {
            if (!applied) {
                applied = true;
                clearBarAnimation();
                $header.addClass("is-sticky is-sticky-animating");
                $bar.one("animationend.pnsHeader webkitAnimationEnd.pnsHeader", function () {
                    $header.removeClass("is-sticky-animating");
                });
                setPadding(h);
            } else {
                setPadding(h);
            }
        } else if (applied) {
            applied = false;
            clearBarAnimation();
            $header.removeClass("is-sticky");
            setPadding(0);
        }
    }

    $(window).on("scroll resize", update);
    $(window).on("load", update);
    update();
});
