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
 * Description: Generates the dashboard for the user. This will be the
 *              first page the user will see upon logging in. It will
 *              poll quick relevant information from the user's account
 *              and connected devices. The idea is that this page will
 *              provide a quick snapshot of their account as a whole.
 */
namespace LastResortRecovery

{

    include_once 'db.php';
    include_once 'session.php';

    class DashboardPage
    {

        public function __construct($connection)
        {
            return DashboardPage::generatePage($connection);
        }

        private function generatePage($connection)
        {
?>
<div class="tab-pane active" id="dashboard">
    <!-- Panels on left side of window. -->
    <div class="dashboard-left">
        <!-- Account Panel on Dashboard -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Account</h3>
            </div>
            <div class="panel-body">
                <h5>Name:</h5><?php echo $_SESSION['username'] ?><br>
                <h5>Username:</h5><?php echo $_SESSION['username'] ?><br>
                <br>
                <h5>Last Login:</h5>
                Nov. 22nd 2014<br>
                <!-- TODO: Pull from DB. -->
                <h5>Account ID:</h5><?php echo $_SESSION['userid'] ?><br>
            </div>
        </div>

        <!-- News Panel on Dashboard -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">News</h3>
            </div>
            <div class="panel-body">
                <h5>Important Information</h5>
                <br> <a href="">See more...</a> <br> <br> Like the name
                says, Last Resort should not be your cure-all for laptop
                security. We at Last Resort highly recommend our users
                take advantage of other hardware and software
                securities. The following list will provide you with
                information on the various other methods of computer
                security. <br>
                <h5>Anti-virus:</h5>
                <a href="">Top 5 Anti-virus softwares.</a><br>
                <h5>Data Encryption:</h5>
                <a href="">What is Data Encryption?</a><br>
                <h5>Cloud Storage:</h5>
                <a href="">Google vs. Amazon, who should I use?</a><br>
                <br> For more information and news about Last Resort and
                computer security in general... <a href="">To the
                    Forums!</a>
            </div>
        </div>
    </div>

    <!-- Panels along right side of window. -->
    <div class="dashboard-right">
        <!-- Devices Panel on Dashboard page. -->
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
        <!-- Missing Devices Panel on Dashboard -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Devices</h3>
            </div>
            <div class="panel-body">


<?php
            $sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";
            
            $result = mysqli_query($connection, $sql);
            
            if ($result->num_rows == 0) {
                echo "You don't have any devices! Let us show you how to add devices to your account!";
            } else {
                echo "<h5>Number of Devices: </h5>";
                echo $result->num_rows . "<br><br>";
            }
            
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
<p>
                    <a href="#help" data-toggle="tab">Add a device!</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
            return 1;
        }
    }
}