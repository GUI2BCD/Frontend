/**
 * This file contains common jQuery and JavaScript functions that may 
 * be used throughout the website
 */

/**
 * Toggles all spans(chevrons) from down to up when an element with 
 * the class "accordion-icon-swap" is clicked.
 */
$(".accordion-icon-swap").click(
        function() {
            $(this).find('.glyphicon').toggleClass('glyphicon-chevron-down').toggleClass(
                    'glyphicon-chevron-up');
        });
