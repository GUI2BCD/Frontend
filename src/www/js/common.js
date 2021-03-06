/**
 * This file contains common jQuery and JavaScript functions that may be used
 * throughout the website
 */

/**
 * Toggles all spans(chevrons) from down to up when an element with the class
 * "accordion-icon-swap" is clicked.
 */
$(".accordion-icon-swap").click(
        function() {
            $(this).find('.glyphicon').toggleClass('glyphicon-chevron-down')
                    .toggleClass('glyphicon-chevron-up');
        });

/** *********************************************************************** */
/** The following group of functions will make sure the browser displays * */
/** the tab that the user was on before a browser refresh. * */
/** * */
/*******************************************************************************
 * Source:
 * http://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh /
 ******************************************************************************/
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
$("ul.nav-pills > li > a").on("show.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * Stores the currently selected tab in the hash value. (Second Tier) - I had to
 * add this to accomadate my drop-down menu.
 */
$("ul.nav-pills > li > ul > li > a").on("show.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

/**
 * On page load - switch to currently selected tab
 */
var hash = window.location.hash;
$('#user-tabs a[href="' + hash + '"]').tab('show');

/**
 * Anchor Offset
 */
var offset = 60;
/*
 * $('a').click(function(event) { // event.preventDefault();
 * $($(this).attr('href'))[0].scrollIntoView(); scrollBy(0, -offset); });
 */

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
        reports : numReports
    }, function(responseText) {

        if (responseText != "OK") {
            $("#accordian" + deviceid).empty().append(responseText);
            $("#reportUpdate" + deviceid).removeClass('hidden');
            $('#reportUpdate' + deviceid).slideDown().delay(5000).slideUp();
        }
    }, "html");
}

/**
 * ################################ JavaScript for the Account Page.
 * ################################
 */

// turn to inline mode
$.fn.editable.defaults.mode = 'inline';

$().ready(function() {
    $('#rootwizard').bootstrapWizard();
    $('#username').editable();
    $('#email').editable();
    $('#phone').editable();
    
    $("#change-password").validate({
        rules : {
            oldpassword : {
                required : true,
                remote : {
                    url : 'validation.php',
                    type : 'post'
                }
            },
            newpassword : {
                required : true
            },
            cnewpassword : {
                required : true,
                equalTo : '#newpassword'
            }
        }, // end rules

        tooltip_options : {
            oldpassword : {
                placement : 'top',
                trigger : 'focus',
            },
            newpassword : {
                placement : 'top',
                trigger : 'focus'
            },
            cnewpassword : {
                placement : 'top',
                trigger : 'focus'
            }
        },
        messages : {
            oldpassword : {
                required : "Old password is required.",
                remote : "Invalid password"
            },
            newpassword : {
                required : "Password is required."
            },
            cnewpassword : {
                required : "Confirming password is required.",
                equalTo : "Passwords do not match."
            }
        }, // end messages
        submitHandler : function(form) {
            encrypt_change();
            form.submit();
        } // end submitHandler
    }); // end validate
    

});
