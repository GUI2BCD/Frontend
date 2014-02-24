<?php
/* Include .PHP files here. */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

Session::startSecureSession();
if (! Session::loginCheck($connection)) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

<title>Last Resort Recovery</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
    href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet"
    href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Custom styles for this template -->
<link href="css/jumbotron.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Local Overrides -->
<link rel="stylesheet" href="./css/verified.css">

</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top"
        role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                    data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Last Resort Recovery</a>
            </div>
            <div class="navbar-right">
                <a class="navbar-brand">Welcome, username!</a>
            </div>
            <div class="navbar-collapse collapse"></div>
            <!--/.navbar-collapse -->
        </div>
    </div>

    <div class="container content">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
            <li><a href="#devices" data-toggle="tab">Devices</a></li>
            <li><a href="#agent" data-toggle="tab">Agent</a></li>
            <li><a href="#account" data-toggle="tab">Account</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="dashboard">


                <div class="dashboard-left">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account</h3>
                        </div>
                        <div class="panel-body">
                            <strong>Name: </strong><br /> <strong>Username:
                            </strong>
                        </div>
                    </div>

                </div>
                <div class="dashboard-right">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account</h3>
                        </div>
                        <div class="panel-body">
                            Name: <br /> Username:
                        </div>
                    </div>

                </div>


            </div>
            <div class="tab-pane" id="devices">test2</div>
            <div class="tab-pane" id="agent">3</div>
            <div class="tab-pane" id="account">and 4</div>
        </div>

        		<!-- FOOTER -->
		<hr>
		<footer>
			<p class="pull-right">
				<a href="#">Back to top</a>
			</p>
			<p>
				&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot;
				<a href="#">Terms</a>
			</p>
		</footer>
        
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script
        src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
