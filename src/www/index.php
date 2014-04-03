<?php
/* Include .PHP files here. */
namespace LastResortRecovery;

include 'db.php';
include 'session.php';
// Redirect to dashboard if already logged in
Session::startSecureSession();
if (Session::loginCheck($connection)) {
    header('Location: dashboard.php');
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

<!-- Load javascript files -->
<script src="js/holder.js"></script>
<script type="text/javascript" src="js/sha512.js"></script>

<!-- Used for hashing passwords post-registration/login -->
<script type="text/javascript">
    function encrypt_login() {
	var password = document.getElementById("password").value;

	var shaObj = new jsSHA(password, "TEXT");
	document.getElementById("password").value = shaObj.getHash("SHA-512", "HEX");
	console.log(shaObj.getHash("SHA-512", "HEX"));
    }

    function encrypt_register() {
	var password = document.getElementById("regpassword").value;

	var shaObj = new jsSHA(password, "TEXT");
	document.getElementById("regpassword").value = shaObj.getHash("SHA-512", "HEX");
	console.log(shaObj.getHash("SHA-512", "HEX"));
    }
</script>

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Last Resort Recovery</a>
			</div>
			<div class="navbar-collapse collapse">
				<form id="login" class="navbar-form navbar-right" role="form"
					action="login.php" method="post">
					<div class="form-group">
						<input id="email" name="email" type="text" placeholder="Email"
							class="form-control" required>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password"
							placeholder="Password" class="form-control" required>
					</div>
					<button type="submit" class="btn btn-success">Sign in</button>
				</form>
			</div>
			<!--/.navbar-collapse -->
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="RegisterForm" tabindex="-1" role="dialog"
		aria-labelledby="RegisterForm" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form id="form-register" class="form-register form-horizontal" role="form" action="register.php" method="post" >
						<h2 class="form-register-heading">Create your account</h2>
						
						<div class="form-group">
						  <input id="username" name="username" type="text" class="form-control" data-toggle="tooltip" data-placement="right" data-content="start" placeholder="Username" required autofocus>
						  <span class="glyphicon form-control-feedback"></span>
                        </div>
                        
                        <div class="form-group has-feedback">
    			          <input id="regemail" name="email" type="email" class="form-control" data-toggle="tooltip" data-placement="right" data-content="start" placeholder="Email address" required>
    			          <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                        </div>
                        
                        <div class="form-group">
	   					  <input id="regpassword" name="password" type="password" class="form-control" data-toggle="tooltip" data-placement="right" data-content="start" placeholder="Password" required>
                          <span class="glyphicon form-control-feedback"></span>
                        </div>
                        
                        <div class="form-group">
						  <input id="regcpassword" name="cpassword" type="password" class="form-control" data-toggle="tooltip" data-placement="right" data-content="start" placeholder="Confirm Password" required>
						  <span class="glyphicon form-control-feedback"></span>
                        </div>
                        
						<button class="btn btn-lg btn-primary btn-block" type="submit">
						  Sign up
						</button>

					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>From lost, to found</h1>
			<p>The simple missing laptop recovery tool</p>
			<p>
				<button class="btn btn-primary btn-lg" data-toggle="modal"
					data-target="#RegisterForm">Sign up</button>
			</p>
		</div>
	</div>


	<!-- Marketing messaging and featurettes
    ================================================== -->
	<!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="container content">

		<!-- START THE FEATURETTES -->


		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">
					Why Last Resort Recovery? <span class="text-muted">It'll blow your
						mind.</span>
				</h2>
				<p class="lead">For the college student, their laptop is a tool
				for academic success, but it can be lost, misplaced, or stolen.
				Last Resort Recovery works to assist you in the recovery of your device.</p>
			</div>
			<div class="col-md-5">
				<img src="images/homeImage1.jpg" alt="HomeImage1">
			</div>
		</div>

		<hr class="featurette-divider">

		<div class="row featurette">
			<div class="col-md-5">
				<img src="images/homeImage2.jpg" alt="HomeImage2">
			</div>
			<div class="col-md-7">
				<h2 class="featurette-heading">
					The Agent: <span class="text-muted">Your recovery friend.</span>
				</h2>
				<p class="lead">An agent for a Linux based operating system will help
				you document your lost device so that assistance for recovery can
				begin right away.</p>
			</div>
		</div>

		<hr class="featurette-divider">

		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">
					The Dashboard: <span class="text-muted">Quick and relevant information for you.</span>
				</h2>
				<p class="lead">Your dashboard will be personalized with the information
				from the agent and user registration to give clear and concise reports
				about the status of your lost device.</p>
			</div>
			<div class="col-md-5">
				<img src="images/homeImage3.jpg" alt="HomeImage3">
			</div>
		</div>

		<hr class="featurette-divider">

		<!-- /END THE FEATURETTES -->



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
	<script 
	    src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="./js/validation.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script
		src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
