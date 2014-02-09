/**
 * JavaScript/jQuery to open the log in dialog and validate the log in
 * information.
 */

$(function() {
// var username = $("#login-username"),
// password = $("#login-password");

    /**
     * Setup for the Log in pop up window.
     */
    $("#login-prompt").dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            "Log In": function() {
                $(this).dialog("close");
            },
            Cancel: function(){
                $(this).dialog("close");
            }
        }
    });
    
    /**
     * Opens the Log In pop up window.
     */
    $( ".login-prompt" )
       .button()
       .click(function() {
           $("#login-prompt").dialog( "open" );
       });
});
