/**
 * Import jQuery and bootstrap
 *
 * @command: npm install jquery
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

$(function() {
    // Sidebar toggle
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
    // Scroll to top events
    var _scrollTimer = null;
    $(window).bind('resize scroll', function() {
        _scrollTimer && clearTimeout(_scrollTimer);
        _scrollTimer = setTimeout(function() {
            if ($(window).scrollTop() > Math.ceil($(window).height()/2)) {
                $('#scrollToTop').show();
            } else {
                $('#scrollToTop').hide();
            }
        }, 200);
    });
    $(document).on('click', '#scrollToTop', function() {
        var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
        $body.animate({
            "scrollTop": 0
        }, 400);
        return false;
    })
});
