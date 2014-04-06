<?php
/* Include .PHP files here. */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';

include_once 'dashboardPage.php';
include_once 'devicePage.php';
include_once 'addDevicePage.php';
include_once 'accountPage.php';

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
            <!-- Brand and toggle are grouped for mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                    data-toggle="collapse"
                    data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Last Resort Recovery</a>
            </div>
                
            <div class="navbar-left collapse navbar-collapse">
                <!-- Nav tabs -->
                <ul class="nav nav-pills" id="user-tabs">
                    <li class="active"><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Devices <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#agent" data-toggle="tab">Add Device</a></li> <!-- TODO: Pull from db -->
                            <li class="divider"></li>
                            <li><a href="#devices" data-toggle="tab">Style 1</a></li> <!-- TODO: Pull from db -->
                            <li class="divider"></li>
                            
                            <?php 
                            $sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";
                            
                            $result = mysqli_query($connection, $sql);
                            
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <li><a href="#device<?php echo $row['id'];?>" data-toggle="tab">Device <?php echo $row['id'];?></a></li>
                                <?php 
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="#account" data-toggle="tab">Account</a></li>
                    <li><a href="#help" data-toggle="tab">Help</a></li>
                </ul>
            </div>
            
            <div class="navbar-right collapse navbar-collapse">
                <a class="navbar-brand">Welcome, <?php echo $_SESSION['username'] ?>!</a>
                <a class="navbar-right" href="logout.php"><button type="button" class="btn btn-primary navbar-button navbar-right">Log Out</button></a>
            </div>
        </div>
    </div>

    <div class="container content">

        <!-- Tab panes -->
        <div class="tab-content">
        
            <!-- Dashboard Tab -->
            <?php new dashboardPage($connection) ?>
            
            <!-- Devices Tab -->
            <?php // new displayDevice( 1 , 1 ) ?>
            
            <!-- Device Page(Generated per device) -->
            <?php 
            $sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";
            
            $result = mysqli_query($connection, $sql);    
            
            ?><div class="tab-pane" id="device1"><?php 
                        
            while ($row = mysqli_fetch_array($result)) {

                new displayDevice($row);
                
            }
            
            ?>
            </div>
            <!-- Agent Tab on Dashboard -->
            <?php new addDevice() ?>
            
            <!-- Account Tab on Dashboard -->
            <?php new accountPage() ?>
            
        </div>

    </div>

    <div class="container content">
        <footer>
            <p class="pull-right">
                <a href="#">Back to top</a>
            </p>
            <p>
                &copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a>
                &middot; <a href="#">Terms</a>
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
        
    <!-- Additional Scripts -->
    <script
        src="./js/common.js"></script>
    
</body>
</html>
