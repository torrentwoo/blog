/**
 * Import jQuery and bootstrap
 *
 * @command: npm install jquery
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

$(function() {
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
});
