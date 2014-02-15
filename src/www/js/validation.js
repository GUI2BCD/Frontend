/**
 * JavaScript/jQuery to validate the log in and registration information.
 */

$().ready(function() {
    //Creates the set of rules that need to be fulfilled for proper registration.
    $("#reg").validate({
        rules: {
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            password2: {
                equalTo: '#password'
            }
        }, //end rules
        messages: {
            username: {
                required: "Username is required."
            },
            email: {
                required: "Email is required."           	
            },
            password: {
                required: "Password is required."
            },
            password2: {
            	equalTo: "Passwords do not match."
            }
        } //end messages
    }); //end validate
}); //end ready