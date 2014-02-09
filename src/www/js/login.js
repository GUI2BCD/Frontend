/**
 * JavaScript/jQuery to open the log in dialog and validate the log in
 * information.
 */

$(function() {
// var username = $("#login-username"),
// password = $("#login-password");
    var $width = 350,
        $height = 300,
        $left = ($(window).width() / 2) - ($width / 2),
        $top = 200;
    
    /**
     * Setup for the Log in pop up window.
     */
    $("#login-prompt").dialog({
        autoOpen: false,
        height: $height,
        width: $width,
        modal: true,
        buttons: {
            "Log In": function() {
                $(this).dialog("close");
            },
            Cancel: function(){
                $(this).dialog("close");
            }
        },
        position: [$left, $top]
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
