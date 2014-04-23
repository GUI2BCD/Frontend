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
<link rel="shortcut icon" href="../images/LRRFavicon.ico">

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

<script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5-jsF9YAtMK3e_zM1rj1XUwCdrkZrK3k&sensor=false">
     </script>

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
                    <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">Last Resort Recovery</a>
            </div>

            <div class="navbar-collapse collapse">
                <!-- Nav tabs -->
                <ul class="nav nav-pills navbar-nav" id="user-tabs">
                    <li class="active"><a href="#dashboard"
                        data-toggle="pill">Dashboard</a></li>
                    <li class="dropdown"><a class="dropdown-toggle"
                        href="#" data-toggle="dropdown">Devices <span
                            class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#help" data-toggle="pill">Add
                                    Device</a></li>
                            <!-- TODO: Pull from db -->
                            <li class="divider"></li>
                            
                            <?php
$sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";

$result = mysqli_query($connection, $sql);
$i = 1;

while ($row = mysqli_fetch_array($result)) {
    ?>
                                <li><a href="#device<?php echo $i;?>"
                                data-toggle="pill"><?php echo $row['name'];?></a></li>

                                <?php
    $i ++;
}
?>
                        </ul></li>
                    <li><a href="#account" data-toggle="pill">Account</a></li>
                    <li><a href="#help" data-toggle="pill">Help</a></li>
                </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION['username']; ?>!<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
            </div>
        </div>
    </div>

    <div id="top" class="container content">

        <!-- Tab panes -->
        <div class="tab-content">

            <!-- Dashboard Tab -->
            <?php new DashboardPage($connection)?>
            
            <!-- Device Page(Generated per device) -->
            <?php
$sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";

$result = mysqli_query($connection, $sql);
$i = 1;
while ($row = mysqli_fetch_array($result)) {
    
    new displayDevice($i, $row, $connection);
    $i ++;
}

?>
            <!-- Agent Tab on Dashboard -->
            <?php new addDevice()?>
            
            <!-- Account Tab on Dashboard -->
            <?php new accountPage()?>
            
        </div>

    </div>

    <div class="container content">
        <footer>
            <p class="pull-right">
                <a href="#top">Back to top</a>
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
      <script src="js/jquery.bootstrap.wizard.min.js"></script>
    <!-- Additional Scripts -->
    <script src="./js/common.js"></script>
    

</body>
</html>
