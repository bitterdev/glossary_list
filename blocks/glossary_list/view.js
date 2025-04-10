/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

(function ($) {
    $(function () {
        $(".glossary-agenda a").bind("click", function() {
            $("html, body").animate({
                scrollTop: $(this).parent().parent().parent().parent().find(".glossary-group[data-first-letter='" + $(this).data("firstLetter") + "']").offset().top + "px"
            }, 300);
        });
    });
})(jQuery);