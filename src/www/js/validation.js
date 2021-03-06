/**
 * JavaScript/jQuery to validate the log in and registration information.
 */

$().ready(
        function() {
            // Creates the set of rules that need to be fulfilled for proper
            // registration.
            $("#form-register").validate(
                    {
                        rules : {
                            username : {
                                required : true,
                                remote : {
                                    url : 'validation.php',
                                    type : 'post'
                                }
                            },
                            email : {
                                required : true,
                                email : true,
                                remote : {
                                    url : 'validation.php',
                                    type : 'post'
                                }
                            },
                            password : {
                                required : true
                            },
                            cpassword : {
                                required : true,
                                equalTo : '#regpassword'
                            }
                        }, // end rules
                        /*
                         * errorPlacement: function(error, element) {
                         * $(element).attr("title", "test"); },
                         */
                        highlight : function(element) {
                            var id_attr = "#" + $(element).attr("id") + "1";
                            $(element).closest('.form-group').removeClass(
                                    'has-success').addClass('has-error');
                            $(id_attr).removeClass('glyphicon-ok').addClass(
                                    'glyphicon-remove');
                        },
                        success : function(element) {
                            var id_attr = "#" + $(element).attr("id") + "1";
                            $(element).closest('.form-group').removeClass(
                                    'has-error').addClass('has-success');
                            $(id_attr).removeClass('glyphicon-remove')
                                    .addClass('glyphicon-ok');
                        },
                        tooltip_options : {
                            username : {
                                placement : 'top',
                                trigger : 'focus',
                            },
                            email : {
                                placement : 'top',
                                trigger : 'focus'
                            },
                            password : {
                                placement : 'top',
                                trigger : 'focus'
                            },
                            cpassword : {
                                placement : 'top',
                                trigger : 'focus'
                            },
                        },
                        messages : {
                            username : {
                                required : "Username is required.",
                                remote : "Username already exists."
                            },
                            email : {
                                required : "Email is required.",
                                remote : "Email already exists."
                            },
                            password : {
                                required : "Password is required."
                            },
                            cpassword : {
                                required : "Confirming password is required.",
                                equalTo : "Passwords do not match."
                            }
                        }, // end messages
                        submitHandler : function(form) {
                            encrypt_register();
                            form.submit();
                        } // end submitHandler
                    }); // end validate

            // Creates the set of rules that need to be fulfilled for proper log
            // in.
            $("#login").validate({
                rules : {
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true
                    }
                }, // end rules
                tooltip_options : {
                    email : {
                        placement : 'bottom',
                        trigger : 'focus'
                    },
                    password : {
                        placement : 'bottom',
                        trigger : 'focus'
                    }
                },
                messages : {
                    email : {
                        required : "Username is required."
                    },
                    password : {
                        required : "Password is required."
                    }
                }, // end messages
                submitHandler : function(form) {
                    encrypt_login();
                    form.submit();
                } // end submitHandler
            }); // end validate
            

        }); // end ready
