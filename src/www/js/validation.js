/**
 * JavaScript/jQuery to validate the log in and registration information.
 */

$().ready(function() {
    //Creates the set of rules that need to be fulfilled for proper registration.
    $("#form-register").validate({
        rules: {
            username: {
                required: true,
                remote: './validation.php'
            },
            email: {
                required: true,
                email: true,
                remote: './validation.php'
            },
            password: {
                required: true
            },
            cpassword: {
                required: true,
                equalTo: '#regpassword'
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
            cpassword: {
                required: "Confirming password is required.",
                equalTo: "Passwords do not match."
            }
        }, //end messages
        submitHandler: function(form){
            encrypt_register();
            form.submit();
        } //end submitHandler
    }); //end validate
    
    //Creates the set of rules that need to be fulfilled for proper log in.
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true,
                remote: './login.php'
            },
            password: {
                required: true,
                remote: './login.php'
            }
        }, //end rules
        messages: {
            email: {
                required: "Username is required.",
                remote: "Username is incorrect or doesn't exist."
            },
            password: {
                required: "Password is required.",
                remote: "Password is incorrect."
            }
        }, //end messages
        submitHandler: function(form){
            encrypt_login();
            form.submit();
        } //end submitHandler
    }); //end validate
}); //end ready