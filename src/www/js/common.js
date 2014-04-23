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
$("ul.nav-pills > li > a").on("show.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * Stores the currently selected tab in the hash value. (Second Tier)
 *      - I had to add this to accomadate my drop-down menu.
 */
$("ul.nav-pills > li > ul > li > a").on("show.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * On page load - switch to currently selected tab
 */
var hash = window.location.hash;
$('#user-tabs a[href="'+ hash + '"]').tab('show');

/**
 * Anchor Offset
 */
var offset = 60;

$('a').click(function(event) {
//    event.preventDefault();
    $($(this).attr('href'))[0].scrollIntoView();
    scrollBy(0, -offset);
});


/**
 * Handles ajax call to toggle device status
 */
$(".toggleStatusButton").click(function() {

    // Holds the device ID for the callback
    var deviceid = $(this).attr('device-id');
    // Disable button until callback comes back
    $('.toggleStatusButton').prop('disabled', true);
    $.post("ajax.php", {
        action : "togglestatus",
        deviceid : deviceid
    }, function(responseText) {
        console.log("statusval-" + deviceid);

        // Update content based on response
        $("#statusval-" + deviceid).html(responseText);
        if (responseText == 'OK') {
            $("#statusval-" + deviceid).removeClass('status-red');
            $("#statusval-" + deviceid).addClass('status-green');
        } else {
            $("#statusval-" + deviceid).addClass('status-red');
            $("#statusval-" + deviceid).removeClass('status-green');
        }
        // Re-enable button
        $('.toggleStatusButton').prop('disabled', false);
        $("#alert" + deviceid).removeClass('hidden');
        $('#alert' + deviceid).slideDown().delay(5000).slideUp();
    }, "html");
});

/**
 * Checks and update content for reporting
 */
function checkReport(deviceid) {
    var numReports = $("#accordian" + deviceid).children().attr("numreports");
    $.post("ajax.php", {
        action : "checkreport",
        deviceid : deviceid,
        reports: numReports
    }, function(responseText) {
        
        if( responseText != "OK" ) {
            $("#accordian" + deviceid).empty().append(responseText);
            $("#reportUpdate" + deviceid).removeClass('hidden');
            $('#reportUpdate' + deviceid).slideDown().delay(5000).slideUp();
        }
    }, "html");
}

$(document).ready(function() {
    $('#rootwizard').bootstrapWizard();  
});

/**
 * #####################################
 * All JavaScript for the Account Page.
 * #####################################
 */

/**
 * Button handler for General Settings
 */
$(".btn-account").click(function() {
    if( $( this ).attr( "value" ) === "Save" ) {
        
        $( this ).addClass( "hide" );
        console.log("Hello" + $( this ).prev().attr( "value" ));
        
        if( $( this ).hasClass( "btn-account-name" ) ) {
            
            $("#acnt-p-name").removeClass( "hide" );
            $("#acnt-inpt-name").addClass( "hide" );
            
        } else if( $( this ).hasClass( "btn-account-username" ) ) {
            
            $("#acnt-p-username").removeClass( "hide" );
            $("#acnt-inpt-username").addClass( "hide" );
            
        } else if( $( this ).hasClass( "btn-account-email" ) ) {
            
            $("#acnt-p-email").removeClass( "hide" );
            $("#acnt-inpt-email").addClass( "hide" );
            
        } else {
            console.log("Account button not recognized.");
        }
        
    } else {
        
        $( this ).addClass( "hide" );
        $( this ).next().removeClass( "hide" );
        
        if( $( this ).hasClass( "btn-account-name" ) ) {
            
            $("#acnt-p-name").addClass( "hide" );
            $("#acnt-inpt-name").removeClass( "hide" );
            
        } else if( $( this ).hasClass( "btn-account-username" ) ) {
            
            $("#acnt-p-username").addClass( "hide" );
            $("#acnt-inpt-username").removeClass( "hide" );
            
        } else if( $( this ).hasClass( "btn-account-email" ) ) {
            
            $("#acnt-p-email").addClass( "hide" );
            $("#acnt-inpt-email").removeClass( "hide" );
            
        } else {
            console.log("Account button not recognized.");
        }
        
    }
});

