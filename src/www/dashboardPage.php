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
    <div class="row page-space">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Devices</h3>
                </div>
                <div class="panel-body">


<?php
            $sql = "SELECT * FROM devices WHERE userid='" . $_SESSION['userid'] . "';";
            
            $result = mysqli_query($connection, $sql);
            
            if ($result->num_rows == 0) {
                echo '<div class="alert alert-info">No devices registered. <a href="./dashboard.php#help" data-toggle="tab"><button type="button" class="btn btn-primary btn-sm">Add device</button></a></div>';
            } else {}
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                
                if ($row['status'] == 'LOST') {
                    echo '<div class="alert alert-danger">';
                } else {
                    echo '<div class="alert alert-success">';
                }
                
                echo "<h5>Device name: </h5>";
                echo $row['name'] . "<br>";
                echo "<h5>Status: </h5>";
                echo $row['status'];
                // TODO Last report
                // TODO Link to device
                echo '<br><a href="#device' . $i ++ . '" data-toggle="tab"><button type="button" class="btn btn-primary btn-xs">View device</button></a></div>';
            }
            ?>
<p></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">General Account Settings</div>
                    <div class="panel-body form-horizontal">
                        <div class="form-group">
                            <label for="username"
                                class="col-xs-2 control-label">Name:</label>
                            <div class="col-xs-10">
                                <a href="#" id="username"
                                    data-type="text"
                                    data-pk="<?php echo $_SESSION['userid']; ?>"
                                    data-url="form.php"
                                    data-title="Enter username"><?php echo $row['username']; ?></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"
                                class="col-xs-2 control-label">Email:</label>
                            <div class="col-xs-10">
                                <a href="#" id="email" data-type="text"
                                    data-pk="<?php echo $_SESSION['userid']; ?>"
                                    data-url="form.php"
                                    data-title="Enter email"><?php echo $row['email']; ?></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone"
                                class="col-xs-2 control-label">Phone:</label>
                            <div class="col-xs-10">
                                <a href="#" id="phone" data-type="text"
                                    data-pk="<?php echo $_SESSION['userid']; ?>"
                                    data-url="form.php"
                                    data-title="Enter phone number"><?php echo $row['phone']; ?></a>
                            </div>
                        </div>
                    </div>
                    <!-- /panel-body -->
                </div>

                <!-- Devices Panel on Dashboard -->

                <!-- News Panel on Dashboard -->

            </div>
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">News</h3>
                    </div>
                    <div class="panel-body">
                        <h5>Important Information</h5>
                        <br> <a href="">See more...</a> <br> <br> Like
                        the name says, Last Resort should not be your
                        cure-all for laptop security. We at Last Resort
                        highly recommend our users take advantage of
                        other hardware and software securities. The
                        following list will provide you with information
                        on the various other methods of computer
                        security. <br>
                        <h5>Anti-virus:</h5>
                        <a href="">Top 5 Anti-virus softwares.</a><br>
                        <h5>Data Encryption:</h5>
                        <a href="">What is Data Encryption?</a><br>
                        <h5>Cloud Storage:</h5>
                        <a href="">Google vs. Amazon, who should I use?</a><br>
                        <br> For more information and news about Last
                        Resort and computer security in general... <a
                            href="">To the Forums!</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<?php
        }
    }
}