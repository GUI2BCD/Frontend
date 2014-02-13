<?php
/* Include .PHP files here. */
namespace LastResortRecovery;

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

<script src="js/holder.js"></script>
<script type="text/javascript" src="js/sha512.js"></script>

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
				<form class="navbar-form navbar-right" role="form"
					action="LRR/login.php" method="post" onSubmit="encrypt_login()">
					<div class="form-group">
						<input id="email" name="email" type="text" placeholder="Email"
							class="form-control" required>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="Password"
							class="form-control" required>
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
					<form class="form-register" role="form" 
					     action="LRR/register.php" method="post" onSubmit="encrypt_register()">
						<h2 class="form-register-heading">Create your account</h2>
						<input id="username" name="username" type="text" class="form-control"
							placeholder="Username" required autofocus>
						<input id="regemail" name="email" type="email" class="form-control"
							placeholder="Email address" required> 
						<input id="regpassword" name="password" type="password" class="form-control" 
						    placeholder="Password" required>
						<input id="regcpassword" name="cpassword" type="password" class="form-control" 
						    placeholder="Confirm Password" required>
						<button class="btn btn-lg btn-primary btn-block" 
						    type="submit">Sign up</button>
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

	<div class="container marketing">

		<!-- START THE FEATURETTES -->


		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">
					First featurette heading. <span class="text-muted">It'll blow your
						mind.</span>
				</h2>
				<p class="lead">Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper. Praesent commodo
					cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
					tellus ac cursus commodo.</p>
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive"
					data-src="js/holder.js/500x500/auto"
					alt="Generic placeholder image">
			</div>
		</div>

		<hr class="featurette-divider">

		<div class="row featurette">
			<div class="col-md-5">
				<img class="featurette-image img-responsive"
					data-src="js/holder.js/500x500/auto"
					alt="Generic placeholder image">
			</div>
			<div class="col-md-7">
				<h2 class="featurette-heading">
					Oh yeah, it's that good. <span class="text-muted">See for yourself.</span>
				</h2>
				<p class="lead">Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper. Praesent commodo
					cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
					tellus ac cursus commodo.</p>
			</div>
		</div>

		<hr class="featurette-divider">

		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">
					And lastly, this one. <span class="text-muted">Checkmate.</span>
				</h2>
				<p class="lead">Donec ullamcorper nulla non metus auctor fringilla.
					Vestibulum id ligula porta felis euismod semper. Praesent commodo
					cursus magna, vel scelerisque nisl consectetur. Fusce dapibus,
					tellus ac cursus commodo.</p>
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive"
					data-src="js/holder.js/500x500/auto"
					alt="Generic placeholder image">
			</div>
		</div>

		<hr class="featurette-divider">

		<!-- /END THE FEATURETTES -->

		<hr>

		<!-- FOOTER -->
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
