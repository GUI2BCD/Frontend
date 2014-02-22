/**
 * JavaScript/jQuery to validate the log in and registration information.
 */

$().ready(function() {
    //Creates the set of rules that need to be fulfilled for proper registration.
    $("#reg").validate({
        rules: {
            username: {
                required: true,
                remote: './LRR/validation.php'
            },
            email: {
                required: true,
                email: true,
                remote: './LRR/validation.php'
            },
            password: {
                required: true
            },
            password2: {
                required: true,
                equalTo: '#password'
            }
        }, //end rules
        messages: {
            username: {
                required: "Username is required.",
                remote: "Username already exists."
            },
            email: {
                required: "Email is required.",
                remote: "Email already exists."
            },
            password: {
                required: "Password is required."
            },
            password2: {
                equalTo: "Passwords do not match."
            }
        } //end messages
    }); //end validate
    
    //Creates the set of rules that need to be fulfilled for proper log in.
    $("#login").validate({
        rules: {
            'login-username': {
                required: true,
                remote: './LRR/login.php'
            },
            'login-password': {
                required: true,
                remote: './LRR/login.php'
            }
        }, //end rules
        messages: {
            'login-username': {
                required: "Username is required.",
                remote: "Username is incorrect or doesn't exist."
            },
            'login-password': {
                required: "Password is required."
                remote: "Password is incorrect."
            }
        } //end messages
    }); //end validate
}); //end ready