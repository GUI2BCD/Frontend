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

    class accountPage
    {

        /**
         */
        public function __construct()
        {
            return accountPage::generatePage();
        }

        /**
         */
        private function generatePage()
        {
            ?>

<div class="tab-pane" id="account">

    <div class="row">

        <div class="col-xs-12 col-sm-6">
            <div class="">
                <div class="panel panel-primary">
                    <div class="panel-heading">General Account Settings</div>
                    <div class="panel-body"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Change Password</div>
                <div class="ChngPass panel-body">
                    Under construction.
                    <form id="change-password"
                        class="form-register form-horizontal"
                        role="form">
                        <div class="form-group has-feedback">
                            <label for="ChngPass-OldPass">Old Password</label>
                            <input type="password"
                                class="ChngPass-input form-control"
                                id="ChngPass-OldPass"
                                placeholder="Enter your old password"> <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="ChngPass-NewPass">New Password</label>
                            <input type="password"
                                class="ChngPass-input form-control"
                                id="ChngPass-NewPass"
                                placeholder="Enter your new password"> <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="ChngPass-ConfNewPass">Confirm
                                New Password</label> <input
                                type="password"
                                class="ChngPass-input form-control"
                                id="ChngPass-ConfNewPass"
                                placeholder="Confirm your new password">
                            <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="ChngPass-btn">
                            <button type="submit"
                                class="btn btn-lg btn-primary btn-block">Change
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