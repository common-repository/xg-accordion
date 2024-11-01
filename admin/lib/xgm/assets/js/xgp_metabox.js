;(function ($) {
    "use strict"

    $(document).ready(function () {

        /*------------------------
        *   Bootstrap Toggle
        * ----------------------*/
        $('.xga_toggle').bootstrapToggle();

        /*-----------------------------
            Copy To Clipboard
        *--------------------------- */
        $(document).on('click','.xgp-copy-cipboard',function () {
            $(this).siblings('#xga_shotcode_wrapper').select();
            document.execCommand('copy');
            $(this).text('Copied');
        });

        /*-----------------------------
        * Init Select 2
        *---------------------------*/
        $('.xgp-select-2').select2();

        /*--------------------------------
        * init wordpress color picker
        * ------------------------------*/
        $('.xgp_color_picker').wpColorPicker();


        /*--------------------------------
        * init wordpress jquery ui tabs
        * ------------------------------*/
        $('.xgp_metabox_tabs,#xgp_tabs').tabs();

        /*---------------------------------
        *   Remove metabox handler
        * --------------------------------*/

    });

})(jQuery);


