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

/**************************************************************************/
/** The following group of functions will make sure the browser displays **/
/** the tab that the user was on before a browser refresh.               **/
/**                                                                      **/
/** Source:
http://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
/**************************************************************************/
/**
 * Prevents the rendering of the default tab.
 */
$('user-tabs').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
});

/**
 * Stores the currently selected tab in the hash value. (First Tier)
 */
$("ul.nav-tabs > li > a").on("show.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * Stores the currently selected tab in the hash value. (Second Tier)
 *      - I had to add this to accomadate my drop-down menu.
 */
$("ul.nav-tabs > li > ul > li > a").on("show.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * On page load - switch to currently selected tab
 */
var hash = window.location.hash;
$('#user-tabs a[href="'+ hash + '"]').tab('show');

$(".toggleStatusButton").click(
	function(){
	        $.post(
	            "ajax.php",
	            {action: "togglestatus", deviceid: $( this ).attr('device-id') },
	            function(responseText){
	                console.log(responseText);
	            },
	            "html"
	        );
	});


