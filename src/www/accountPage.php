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
 * Description: Generates the Account Page. Will be called when the user
 *              navigates to the "Account" page once they have logged in.
 *              
 *              This page will allow the user to view and manage their 
 *              account and personal data.
 */
namespace LastResortRecovery

{

    include_once 'config.php';
    include_once 'db.php';

    class accountPage
    {

        /**
         */
        public function __construct($connection)
        {
            return accountPage::generatePage($connection);
        }

        /**
         */
        private function generatePage($connection)
        {
            ?>

<div class="tab-pane" id="account">
<?php
            $accountsql = "SELECT * FROM users WHERE id='" . $_SESSION['userid'] . "' LIMIT 1;";
            
            $account = mysqli_query($connection, $accountsql);
            
            $row = mysqli_fetch_array($account);
            ?>

	<div class="row page-space">

		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">General Account Settings</div>
				<div class="panel-body form-horizontal">
					<div class="form-group">
						<label for="username" class="col-xs-2 control-label">Name:</label>
						<div class="col-xs-10">
							<a href="#" id="username" data-type="text"
								data-pk="<?php echo $_SESSION['userid']; ?>"
								data-url="form.php" data-title="Enter username"><?php echo $row['username']; ?></a>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-xs-2 control-label">Email:</label>
						<div class="col-xs-10">
							<a href="#" id="email" data-type="text"
								data-pk="<?php echo $_SESSION['userid']; ?>"
								data-url="form.php" data-title="Enter email"><?php echo $row['email']; ?></a>
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-xs-2 control-label">Phone:</label>
						<div class="col-xs-10">
							<a href="#" id="phone" data-type="text"
								data-pk="<?php echo $_SESSION['userid']; ?>"
								data-url="form.php" data-title="Enter phone number"><?php echo $row['phone']; ?></a>
						</div>
					</div>
				</div>
				<!-- /panel-body -->
			</div>
			<!-- /panel -->
		</div>
		<!-- /General Account Settings -->

		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Change Password</div>
				<div class="panel-body">
					<form id="change-password" class="form-register form-horizontal"
						role="form" action="register.php" method="post">
						<div class="form-group has-feedback">
							<label for="oldpassword">Old Password</label> <input
								type="password" class="form-control" id="oldpassword"
								placeholder="Enter your old password"> <span
								class="glyphicon form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<label for="newpassword">New Password</label> <input
								type="password" class="form-control" id="newpassword"
								placeholder="Enter your new password"> <span
								class="glyphicon form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<label for="cnewpassword">Confirm New Password</label> <input
								type="password" class="form-control" id="cnewpassword"
								placeholder="Confirm your new password"> <span
								class="glyphicon form-control-feedback"></span>
						</div>
						<div class="">
							<button type="submit" class="btn btn-lg btn-primary btn-block">Change
								Password</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

</div>
<?php
        }
    }
}