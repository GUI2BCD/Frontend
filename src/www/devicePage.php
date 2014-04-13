<?php
/**
 * University of Massachusetts Lowell
 * GUI Programming II, Prof. Jesse Heines
 *
 * Last Resort Recovery
 * Authors - David Jelley, Jr.
 *           Cameron Morris
 *           Benjamin Cao
 *
 * Description: Generates a device page based on the device
 *              passed to the constructor. This may be called
 *              multiple times depending on the number of devices
 *              on the account.
 */
namespace LastResortRecovery

{

    class DisplayDevice
    {

        public function __construct($i, $deviceRow, $connection)
        {
            return DisplayDevice::generatePageNew($i, $deviceRow, $connection);
        }

        private function generatePageOld()
        {
?>
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
                <div class="panel-title accordion-icon-swap"
                    data-toggle="collapse" data-parent="#accordion"
                    href="#collapse<?php echo $i ?>">
                    <p class="pull-right">
                        <strong>ID: </strong><?php echo $row['id'] ?></p>
                    <p class="">
                        <strong><?php echo $row['name'] ?></strong>
                    </p>
                    <div class="panel-icon-centered">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </div>
                </div>
            </div>
            <div id="collapse<?php echo $i ?>"
                class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="accordion-status">
                        <h4>Status:</h4>
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
                        <h5>Date Added:</h5><?php echo 'todo'?><br>
                        <h5>Agent Version:</h5>
                        Linux 0.1<br>
                    </div>
                    <div class="column-right">
                        <h5>Poll Interval:</h5>
                        30 sec<br>
                        <h5>Last Report Received:</h5><?php echo $reportrow['time']?><br>
                    </div>

                    <div class="panel-body accordion-body clear">
                        <h4>Latest Report:</h4>
                        <br>
                        <br>
                        <h5>Local IP Address:</h5>
                        <br>
                        <code>
                                                <?php echo nl2br($reportrow['localip'])?>
                                                </code>
                        <br>
                        <h5>Remote IP Address:</h5>
                        <br>
                        <code><?php echo $reportrow['remoteip']?></code>
                        <br> <br>
                        <h5>Detected WiFi Hotspot(s):</h5>
                        <br>
                        <code>
                                                <?php echo nl2br($reportrow['wifi'])?>
                                                </code>
                        <br>
                        <h5>Trace Route:</h5>
                        <br>
                        <code><?php echo nl2br($reportrow['traceroute'])?></code>
                    </div>

                </div>
            </div>
        </div>
            
            
                                
                <?php
                $i ++;
            }
?>
                                
                                
                                
                            </div>

</div>
<?php
            return 1;
        }

        private function generatePageNew($i, $deviceRow, $connection)
        {
?>
<div class="tab-pane" id="device<?php echo $i;?>">
    <!-- Device Information -->
    <div class="device-panel-left">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Device Information</h3>
            </div>
            <div class="panel-body">
                Status: <br>
                <br> Date Added: <br> Poll Interval: <br> Agent Version:
                <br> Last Reported: <br> <br> <br> <br> <br>
            </div>
        </div>
    </div>
    <!-- END OF DEVICE INFO -->
    <!-- Device - Last Known Location -->
    <div class="device-panel-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Last Known Location</h3>
            </div>
            <div class="panel-body clear-padding">
                                <?php //@codingStandardsIgnoreStart ?>
                                <!-- Google Maps Embedding - Plan to make this generated and code style compliant. -->
                <script type="text/javascript"
                    src="http://maps.google.com/maps/api/js?sensor=false"></script>
                <div
                    style="overflow: hidden; height: 400px; width: 700px;">
                    <div id="gmap_canvas"
                        style="height: 400px; width: 680px;"></div>
                    <a class="google-map-code"
                        href="http://www.embed-google-map.com/de/"
                        id="get-map-data">google maps einbinden</a>
                    <iframe
                        src="http://www.embed-google-map.com/map-embed.php"></iframe>
                    <a class="google-map-data"
                        href="http://www.stromleo.de" id="get-map-data">hier
                        umgeleitet</a>
                </div>
                <script type="text/javascript"> function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(42.6530618,-71.32574769999997),mapTypeId: google.maps.MapTypeId.HYBRID};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(42.6530618, -71.32574769999997)});infowindow = new google.maps.InfoWindow({content:"<div style='position:relative;line-height:1.34;overflow:hidden;white-space:nowrap;display:block;'><div style='margin-bottom:2px;font-weight:500;'>Area 51</div><span>1 University Way <br>  Lowell</span></div>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                                <?php //@codingStandardsIgnoreEnd ?>
                            </div>
        </div>
    </div>
    <!-- END OF DEVICE - LAST KNOWN LOCATION -->

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

                    <?php 
                    $reportsql = "SELECT * FROM reports WHERE deviceid='" . $deviceRow['id'] . "' ORDER BY 'time' ASC LIMIT 5;";
                    
                    $reports = mysqli_query($connection, $reportsql);
                    
                    for( $j = 1 ; $j <= 5 ; $j++ ) {
                        $row = mysqli_fetch_array($reports);

                        echo '<a href=#recentRecord' . $j .'">';
                        echo $row['time'];
                        echo '</a><br>';
                        
                    }
                    
                    echo '</div>';
                    echo '<div class="records-column-right">';
                    
                    for( $j = 6 ; $j <= 10 ; $j++ ) {
                        $row = mysqli_fetch_array($reports);
                    
                        echo '<a href=#recentRecord' . $j .'">';
                        echo $row['time'];
                        echo '</a><br>';
                    
                    }
                    ?>
                    
                    </div>
                </fieldset>
            </div>
            <!-- END RECENT RECORDS -->
            <!-- Saved Records -->
            <div class="device-group-right">
                <fieldset>
                    <legend>Saved Records</legend>
                    <div class="records-column-left">
                        This feature has not been added yet.<br><br><br><br><br>
                    </div>
                    <div class="records-column-right">

                    </div>
                </fieldset>
            </div>
            <!-- END SAVED RECORDS -->

            <!-- Record Accordion -->
            <div class="device-accordion clear">
                <div class="panel-group spacer" id="accordion-device">

                <?php 
                // Renders the last 10 records into an accordian.
                
                $reportsql = "SELECT * FROM reports WHERE deviceid='" . $row['id'] . "' ORDER BY 'time' ASC LIMIT 5;";
                
                $reports = mysqli_query($connection, $reportsql);
                
                for( $j = 1 ; $j <= 10 ; $j++ ) {
                    $row = mysqli_fetch_array($reports);
                    
                    echo '<div id="recentRecord' . $j . '" class="panel panel-default">';
                    echo '<div class="panel-heading">';
                    echo '<div class="panel-title accordion-icon-swap"';
                    echo ' data-toggle="collapse"';
                    echo ' data-parent="#accordion-device"';
                    echo ' href="#collapseDeviceOne">';
                    echo '<p class="center">' . $row['time'] . '</p>';
                    echo '<div class="panel-icon-centered">';
                    echo '<span class="glyphicon glyphicon-chevron-down"></span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div id="collapseDeviceOne"';
                    echo ' class="panel-collapse collapse">';
                    echo '<div class="panel-body">';
                    
                    // Put the record's content here.
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    
                    
                }
                
                ?>

                </div>
                <!-- END OF ACCORDION -->
            </div>
            <!-- END RECORD ACCORDION -->
        </div>
    </div>
    <!-- END OF DEVICE RECORDS CONTAINER -->

</div>
<?php
            return 1;
        }
    }
}