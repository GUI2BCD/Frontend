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
            <div id="reportUpdate<?php echo $deviceRow['id'];?>" class="alert alert-warning alert-dismissable hidden">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>New report received.</strong>
            </div> 
            <b>Name:</b> <?php echo $deviceRow['name']?>
            <br>
            <?php 
            $reportsql = "SELECT time FROM reports WHERE deviceid='" . $deviceRow['id'] . "' ORDER BY time DESC LIMIT 1;";
                    
            $reports = mysqli_query($connection, $reportsql);

            $row = mysqli_fetch_array($reports);
            ?>
                <b>Status:</b> <?php 
                if ($deviceRow['status'] == "OK") {
                    echo '<h4 id="statusval-'.$deviceRow['id'].'" class="status-green">';
                } else {
                    echo '<h4 id="statusval-'.$deviceRow['id'].'" class="status-red">';
                }
                echo $deviceRow['status'] . '</h4>';
                ?> 
                <br>
                
                <b>Poll Interval:</b> 30 seconds<br> 
                <b>Agent Version:</b> Beta 0.02<br>
                <b>Last Reported:</b> <?php echo $row['time']; ?><br>
                
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Device Controls</h3>
            </div>
            <div class="panel-body">
             <?php 
             echo '<button device-id="' .
             $deviceRow['id'] .'" type="button" class="toggleStatusButton btn btn-danger btn-xs">Toggle status</button>';
             ?>
             
             <div id="alert<?php echo $deviceRow['id']; ?>" class="alert alert-warning alert-dismissable hidden">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <strong>Device updated</strong> Please wait at least 30 seconds for a report.
             </div>
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
                    style="overflow: hidden; height: 243px; width: 700px;">
                    <div id="gmap_canvas"
                        style="height: 243px; width: 680px;"></div>
                    <a class="google-map-code"
                        href="http://www.embed-google-map.com/de/"
                        id="get-map-data">google maps einbinden</a>
                    <iframe
                        src="http://www.embed-google-map.com/map-embed.php"></iframe>
                    <a class="google-map-data"
                        href="http://www.stromleo.de" id="get-map-data">hier
                        umgeleitet</a>
                </div>
                <script type="text/javascript"> function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(42.6530618,-71.32574769999997),mapTypeId: google.maps.MapTypeId.HYBRID};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(42.6530618, -71.32574769999997)});infowindow = new google.maps.InfoWindow({content:"<div style='position:relative;line-height:1.34;overflow:hidden;white-space:nowrap;display:block;'><div style='margin-bottom:2px;font-weight:500;'>Example</div><span>1 University Way <br>  Lowell</span></div>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                
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
                    $reportsql = "SELECT * FROM reports WHERE deviceid='" . $deviceRow['id'] . "' ORDER BY time DESC LIMIT 10;";
                    
                    $reports = mysqli_query($connection, $reportsql);
                    
                    for( $j = 1 ; $j <= 5 ; $j++ ) {
                        $row = mysqli_fetch_array($reports);

                        echo '<a href="#recentRecord' . $deviceRow['id'] . '-' . $j . '">';
                        echo $row['time'];
                        echo '</a><br>';
                        
                    }
                    
                    echo '</div>';
                    echo '<div class="records-column-right">';
                    
                    for( $j = 6 ; $j <= 10 ; $j++ ) {
                        $row = mysqli_fetch_array($reports);
                    
                        echo '<a href="#recentRecord' . $deviceRow['id'] . '-' . $j . '">';
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
                
                $reportsql = "SELECT * FROM reports WHERE deviceid='" . $deviceRow['id'] . "' ORDER BY time DESC LIMIT 10;";
                
                $reports = mysqli_query($connection, $reportsql);
                
                for( $j = 1 ; $row = mysqli_fetch_array($reports) ; $j++ ) {
                    
                    
                    echo '<div id="recentRecord' . $deviceRow['id'] . '-' . $j . '" class="panel panel-default">';
                    echo '<div class="panel-heading">';
                    echo '<div class="panel-title accordion-icon-swap"';
                    echo ' data-toggle="collapse"';
                    echo ' data-parent="#accordion-device"';
                    echo ' href="#collapseRecentRecord' . $deviceRow['id'] . '-' . $j . '">';
                    echo '<p class="center">' . $row['time'] . '</p>';
                    echo '<div class="panel-icon-centered">';
                    echo '<span class="glyphicon glyphicon-chevron-down"></span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div id="collapseRecentRecord' . $deviceRow['id'] . '-' . $j . '"';
                    echo ' class="panel-collapse collapse">';
                    echo '<div class="panel-body">';
                    ?>
                    <h5>Screenshot:</h5>
                    <br>
                    <a href=<?php 
                    if( file_exists('files/'.$row['id'].'_screenshot.png')) {
                        echo '"files/'.$row['id'].'_screenshot.png"';
                    }
                    else {
                        echo "#";
                    }
                    ?> class="thumbnail">
                    <img alt="No image" <?php 
                    if( file_exists('files/'.$row['id'].'_screenshot.png')) {
                        echo 'src="files/'.$row['id'].'_screenshot.png">';
                    }
                    else {
                        echo 'data-src="js/holder.js/500x500/auto">';
                    }
                    ?>
                    </a>
                    <br>
                    <h5>Webcam:</h5>
                    <br>
                    <a href=<?php 
                    if( file_exists('files/'.$row['id'].'_webcam.jpeg')) {
                        echo '"files/'.$row['id'].'_webcam.jpeg"';
                    }
                    else {
                        echo "#";
                    }
                    ?> class="thumbnail">
                    <img alt="No image" <?php 
                    if( file_exists('files/'.$row['id'].'_webcam.jpeg')) {
                        echo 'src="files/'.$row['id'].'_webcam.jpeg">';
                    }
                    else {
                        echo 'data-src="js/holder.js/500x500/auto">';
                    }
                    ?>
                    </a>
                    <br>
                    <h5>Local IP Address:</h5>
                        <br>
                        <code>
                                                <?php echo nl2br($row['localip'])?>
                                                </code>
                        <br>
                        <h5>Remote IP Address:</h5>
                        <br>
                        <code><?php echo $row['remoteip']?></code>
                        <br> <br>
                        <h5>Detected WiFi Hotspot(s):</h5>
                        <br>
                        <code>
                                                <?php echo nl2br($row['wifi'])?>
                                                </code>
                        <br>
                        <h5>Trace Route:</h5>

                        <br>
                        <code><?php echo nl2br($row['traceroute'])?></code>
											  <br>
                        <a class="back-to-top pull-right" href="#top">Back to top</a>
                    <?php 
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

        }
    }
}