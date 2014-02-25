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
                <a class="navbar-brand">Welcome, <?php echo $_SESSION['username'] ?>!</a>
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
            <!-- Dashboard Tab -->
            <div class="tab-pane active" id="dashboard">
                <!-- Panels on left side of window. -->
                <div class="dashboard-left">
                    <!-- Account Panel on Dashboard -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account</h3>
                        </div>
                        <div class="panel-body">
                            <strong>Name: </strong><?php echo $_SESSION['username'] ?><br>
                            <strong>Username: </strong><?php echo $_SESSION['username'] ?><br> <br>
                            <strong>Last Login: </strong>Nov. 22nd 2014<br><!-- TODO: Pull from DB. -->
                            <strong>Account ID: </strong><?php echo $_SESSION['userid'] ?><br>
                        </div>
                    </div>

                    <!-- News Panel on Dashboard -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">News</h3>
                        </div>
                        <div class="panel-body">
                            <strong>Important Information</strong><br>
                            <a href="">See more...</a>
                            <br> <br> 
                            Like
                            the name says, Last Resort should not be
                            your cure-all for laptop security. We at
                            Last Resort highly recommend our users take
                            advantage of other hardware and software
                            securities. The following list will provide
                            you with information on the various other
                            methods of computer security. <br> 
                            <strong>Anti-virus: </strong>
                            <a href="">Top 5 Anti-virus softwares.</a><br> 
                            <strong>Data Encryption: </strong> 
                            <a href="">What is Data Encryption?</a><br> 
                            <strong>Cloud Storage: </strong> 
                            <a href="">Google vs. Amazon, who should I use?</a><br><br>
                            For more information and news about Last
                            Resort and computer security in general... 
                            <a href="">To the Forums!</a>
                        </div>
                    </div>
                </div>
                <!-- Panels along right side of window. -->
                <div class="dashboard-right">
                    <!-- Devices Panel on Dashboard page. -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Devices</h3>
                        </div>
                        <div class="panel-body">
                        
                        <?php 
                        
                        $sql = "SELECT * FROM devices WHERE userid='".$_SESSION['userid']."';";
    
                        $result = mysqli_query($connection, $sql);
                        
                        echo "<strong>Number of Devices: </strong>";
                        echo $result->num_rows . "<br><br>";
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<strong>Device name: </strong>";
                            echo $row['name'] . "<br>";
                            echo "<strong>ID: </strong>";
                            echo $row['id'] . "<br>";
                            echo "<strong>Status: </strong>";
                            echo $row['status'] . "<br>";
                            // TODO Last report
                            // TODO Link to device
                            echo "<br>";
                        }
                        
                        ?>
                        </div>
                    </div>
                    <!-- Missing Devices Panel on Dashboard -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Missing Devices</h3>
                        </div>
                        <div class="panel-body">

                        <?php 
                        
                        $sql = "SELECT * FROM devices WHERE status='LOST' AND userid='".$_SESSION['userid']."';";
    
                        $result = mysqli_query($connection, $sql);
                        
                        echo "<strong>Number of Devices: </strong>";
                        echo $result->num_rows . "<br><br>";
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<strong>Device name: </strong>";
                            echo $row['name'] . "<br>";
                            echo "<strong>Current status: </strong>";
                            echo $row['status'] . "<br>";
                            echo "<strong>Poll Interval: </strong> 30 seconds<br>";
                            echo "<strong>Reports: </strong>";
                            
                            $reportsql = "SELECT * FROM reports WHERE deviceid='"
                            .$row['id']."' ORDER BY 'time' ASC LIMIT 5;";
                            
                            $reports = mysqli_query($connection, $reportsql);
                            
                            echo $reports->num_rows . "<br>";
                            while ( $reportrow = mysqli_fetch_array($reports) ) {
                                echo '<a class="report-link" href="report.php?id=';
                                echo $reportrow['id'];
                                echo '">';
                                echo $reportrow['time'] . "</a>";
                                echo '<br>';
                            }
                            echo "<br>";
                        }
                        
                        ?>


                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Devices Tab -->
            <div class="tab-pane" id="devices">
                <br /> This page is currently under construction.
            </div>
            <div class="tab-pane" id="agent">
                <br /> This page is currently under construction.
            </div>
            <div class="tab-pane" id="account"></div>
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
</body>
</html>
