(function ($) {
    $(function () {
        $(".glossary-agenda a").bind("click", function () {
            $("html, body").animate({
                scrollTop: $(this).closest(".glossary-list").find(".glossary-group[data-first-letter='" + $(this).data("firstLetter") + "']").offset().top + "px"
            }, 300);
        });
    });
})(jQuery);