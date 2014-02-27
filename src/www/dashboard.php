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
            <div class="navbar-right navbar-collapse collapse">
                <a class="navbar-brand">Welcome, <?php echo $_SESSION['username'] ?>!</a>
            </div>
            <!--/.navbar-collapse -->
        </div>
    </div>

    <div class="container content">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="user-tabs">
            <li class="active"><a href="#dashboard" data-toggle="tab">Dashboard</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Devices <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#devices" data-toggle="tab">All</a></li> <!-- TODO: Pull from db -->
                    <li class="divider"></li>
                    <li><a href="#device1" data-toggle="tab">Device One</a></li> <!-- TODO: Pull from db -->
                    <li><a href="#device2" data-toggle="tab">Device Two</a></li> <!-- TODO: Pull from db -->
                </ul>
            </li>
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
                            <h5>Name: </h5><?php echo $_SESSION['username'] ?><br>
                            <h5>Username: </h5><?php echo $_SESSION['username'] ?><br> <br>
                            <h5>Last Login: </h5>Nov. 22nd 2014<br><!-- TODO: Pull from DB. -->
                            <h5>Account ID: </h5><?php echo $_SESSION['userid'] ?><br>
                        </div>
                    </div>

                    <!-- News Panel on Dashboard -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">News</h3>
                        </div>
                        <div class="panel-body">
                            <h5>Important Information</h5><br>
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
                            <h5>Anti-virus: </h5>
                            <a href="">Top 5 Anti-virus softwares.</a><br> 
                            <h5>Data Encryption: </h5> 
                            <a href="">What is Data Encryption?</a><br> 
                            <h5>Cloud Storage: </h5> 
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
$sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";

$result = mysqli_query($connection, $sql);

echo "<h5>Number of Devices: </h5>";
echo $result->num_rows . "<br><br>";

while ($row = mysqli_fetch_array($result)) {
    echo "<h5>Device name: </h5>";
    echo $row['name'] . "<br>";
    echo "<h5>ID: </h5>";
    echo $row['id'] . "<br>";
    echo "<h5>Status: </h5>";
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


$sql = "SELECT * FROM devices WHERE status='LOST' AND userid='" . $_SESSION['userid'] . "';";

$result = mysqli_query($connection, $sql);

echo "<h5>Number of Devices: </h5>";
echo $result->num_rows . "<br><br>";

while ($row = mysqli_fetch_array($result)) {
    echo "<h5>Device name: </h5>";
    echo $row['name'] . "<br>";
    echo "<h5>Current status: </h5>";
    echo $row['status'] . "<br>";
    echo "<h5>Poll Interval: </h5> 30 seconds<br>";
    echo "<h5>Reports: </h5>";
    
    $reportsql = "SELECT * FROM reports WHERE deviceid='" . $row['id'] . "' ORDER BY 'time' ASC LIMIT 5;";
    
    $reports = mysqli_query($connection, $reportsql);
    
    echo $reports->num_rows . "<br>";
    while ($reportrow = mysqli_fetch_array($reports)) {
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

                <!-- TODO: Generate based on devices. -->
                <div class="panel-group spacer" id="accordion">
<?php 
$sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";

$result = mysqli_query($connection, $sql);
$i = 0;


while ($row = mysqli_fetch_array($result)) {

    $reportsql = "SELECT * FROM reports WHERE deviceid='" . $row['id'] . "' ORDER BY 'time' ASC LIMIT 1;";

    $reports = mysqli_query($connection, $reportsql);

    $reportrow = mysqli_fetch_array($reports);

    ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title accordion-icon-swap" data-toggle="collapse" 
                            data-parent="#accordion" href="#collapse<?php echo $i ?>">
                                <p class="pull-right"><strong>ID: </strong><?php echo $row['id'] ?></p>
                                <p class=""><strong><?php echo $row['name'] ?></strong></p>
                                <div class="panel-icon-centered">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </div>
                            </div>
                        </div>
                        <div id="collapse<?php echo $i ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="accordion-status">
                                    <h4>Status: </h4>
    <?php 
    if ($row['status'] == "OK") {
        echo '<h4 class="status-green">';
    } else {
        echo '<h4 class="status-red">';
    }
    echo $row['status'] . '</h4>';
    ?>
                                </div>
                                
                                <div class="column-left">
                                    <h5>Date Added: </h5><?php echo 'todo'?><br>
                                    <h5>Agent Version: </h5>Linux 0.1<br>
                                </div>
                                <div class="column-right">
                                    <h5>Poll Interval: </h5>30 sec<br>
                                    <h5>Last Report Received: </h5><?php echo $reportrow['time']?><br>
                                </div>

                                <div class="panel-body accordion-body clear">
                                    <h4>Latest Report:</h4><br><br>
                                    <h5>Local IP Address: </h5><br><code>
                                    <?php echo nl2br($reportrow['localip'])?>
                                    </code><br>
                                    <h5>Remote IP Address: </h5><br><code><?php echo $reportrow['remoteip']?></code><br>
                                    <br>
                                    <h5>Detected WiFi Hotspot(s):</h5><br><code>
                                    <?php echo nl2br($reportrow['wifi'])?>
                                    </code><br>
                                    <h5>Trace Route:</h5><br><code><?php echo nl2br($reportrow['traceroute'])?></code>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    
    <?php
    $i++;
}
?>
                    
                    
                    
                </div>
                    
            </div>
            
            <!-- Device Page(Generated per device) -->
            <div class="tab-pane" id="device1">
                    <!-- Device Information -->
                    <div class="device-panel-left">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                               <h3 class="panel-title">Device Information</h3>
                            </div>
                            <div class="panel-body">
                                Status: <br><br>
                                Date Added: <br>
                                Poll Interval: <br>
                                Agent Version: <br>
                                Last Reported: <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div><!-- END OF DEVICE INFO -->
                    <!-- Device - Last Known Location -->
                    <div class="device-panel-right">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                               <h3 class="panel-title">Last Known Location</h3>
                            </div>
                            <div class="panel-body clear-padding">
                                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:400px;width:700px;"><div id="gmap_canvas" style="height:400px;width:680px;"></div><a class="google-map-code" href="http://www.embed-google-map.com/de/" id="get-map-data">google maps einbinden</a><iframe src="http://www.embed-google-map.com/map-embed.php"></iframe><a class="google-map-data" href="http://www.stromleo.de" id="get-map-data">hier umgeleitet</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(42.6530618,-71.32574769999997),mapTypeId: google.maps.MapTypeId.HYBRID};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(42.6530618, -71.32574769999997)});infowindow = new google.maps.InfoWindow({content:"<div style='position:relative;line-height:1.34;overflow:hidden;white-space:nowrap;display:block;'><div style='margin-bottom:2px;font-weight:500;'>Area 51</div><span>1 University Way <br>  Lowell</span></div>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                            </div>
                        </div>
                    </div><!-- END OF DEVICE - LAST KNOWN LOCATION -->
                    
                    <!-- Device container for all records -->
                    <div class="panel panel-primary device-records clear">
                        <div class="panel-heading">
                           <h3 class="panel-title">Last Known Location</h3>
                        </div>
                        <div class="panel-body">
                        <!-- Recent Records -->
                        <div class="device-group-left">
                            <fieldset>
                                <legend>Recent Records</legend>
                                <div class="records-column-left">
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                </div>
                                <div class="records-column-right">
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                </div>
                            </fieldset>
                        </div><!-- END RECENT RECORDS -->
                        <!-- Saved Records -->
                        <div class="device-group-right">
                            <fieldset>
                                <legend>Saved Records</legend>
                                <div class="records-column-left">
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                </div>
                                <div class="records-column-right">
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                    <a href="">12:37AM 11/12/2015</a><br>
                                </div>
                            </fieldset>
                        </div><!-- END SAVED RECORDS -->
                        
                        <!-- Record Accordion -->
                        <div class="device-accordion clear">
                            <div class="panel-group spacer" id="accordion-device">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title accordion-icon-swap" data-toggle="collapse" 
                            data-parent="#accordion-device" href="#collapseDeviceOne">
                                <p class="center">Date of Record</p>
                                <div class="panel-icon-centered">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </div>
                            </div>
                        </div>
                        <div id="collapseDeviceOne" class="panel-collapse collapse">
                            <div class="panel-body">
                            </div>
                        </div>
                   </div><!-- END OF PANEL 1 -->
                   
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title accordion-icon-swap" data-toggle="collapse" 
                            data-parent="#accordion-device" href="#collapseDeviceTwo">
                                <p class="center">Date of Record</p>
                                <div class="panel-icon-centered">
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </div>
                            </div>
                        </div>
                        <div id="collapseDeviceTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                            heelo
                            </div>
                        </div>
                   </div><!-- END OF PANEL 2 -->
                   
               </div> <!-- END OF ACCORDION -->
                        </div><!-- END RECORD ACCORDION -->
                        </div>
                    </div><!-- END OF DEVICE RECORDS CONTAINER -->
                
            </div><!-- END OF DEVICE(Individual) -->
            
            
            
            <div class="tab-pane" id="device2">
                <h2>Currently under construction.</h2>
            </div>
            
            <!-- Agent Tab on Dashboard -->
            <div class="tab-pane" id="agent">
                <ol>
                    <!-- Download link isn't actually for real. Just filler. -->
                    <li>Download <a href="/download/agent.deb">agent.deb</a> file.</li>
                    <li>Install with deb file by either using a package manager or running:<br>
                        <kbd>dpkg -i agent.deb</kbd>
                        <br>
                        <kbd>sudo apt-get -f install</kbd>
                    </li>
                    <li>Run linux_agent.</li>
                    <li>Follow application instructions.</li>
                </ol>
            </div>
            
            <!-- Account Tab on Dashboard -->
            <div class="tab-pane" id="account">
            <br /> This page is currently under construction.</div>
            
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
