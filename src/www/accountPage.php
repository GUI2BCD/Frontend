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
    <div class="row page-space">

        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">General Account Settings</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form">

                        <div class="form-group">
                            <label id="acnt-lb-name" class="col-xs-2 control-label">Name</label>
                            <div class="col-xs-8">
                                <p id="acnt-p-name" class="form-control-static">Sir Bob
                                    Wilson Smith Sr.</p>
                                <input id="acnt-inpt-name" type="text"
                                    class="hide form-control"
                                    id="editName"
                                    placeholder="Enter your name.">
                            </div>
                            <div class="col-xs-2">
                                <button type="button"
                                    class="btn btn-sm btn-primary btn-block btn-account btn-account-name">
                                    <span
                                        class="glyphicon glyphicon-pencil"></span>
                                    Edit
                                </button>
                                <button type="button"
                                    class="hide btn btn-sm btn-primary btn-block btn-account btn-account-name">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label id="acnt-lb-username" class="col-xs-2 control-label">Username</label>
                            <div class="col-xs-8">
                                <p id="acnt-p-name" class="hide form-control-static">John
                                    Doe</p>
                                <input id="acnt-lb-name" type="text" class="form-control"
                                    id="editName"
                                    placeholder="Example after you click edit.">
                            </div>
                            <div class="col-xs-2">
                                <button id="acnt-lb-name" type="button"
                                    class="hide btn btn-sm btn-primary btn-block btn-account">
                                    <span
                                        class="glyphicon glyphicon-pencil"></span>
                                    Edit
                                </button>
                                <button id="acnt-lb-name" type="button"
                                    class="btn btn-sm btn-primary btn-block btn-account">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 control-label">Email</label>
                            <div class="col-xs-8">
                                <p class="form-control-static">test@test.com</p>
                                <input type="text"
                                    class="hide form-control"
                                    id="editName"
                                    placeholder="Enter your name.">
                            </div>
                            <div class="col-xs-2">
                                <button type="button"
                                    class="test btn btn-sm btn-primary btn-block btn-account">
                                    <span
                                        class="glyphicon glyphicon-pencil"></span>
                                    Edit
                                </button>
                                <button type="button"
                                    class="hide btn btn-sm btn-primary btn-block btn-account">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">Last
                                    changed 4/14/2014</p>
                            </div>
                        </div>

                    </form>
                    <strong class="center">Under Construction</strong>
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
                    <strong class="center">Under construction.</strong>
                    <form id="change-password"
                        class="form-register form-horizontal"
                        role="form">
                        <div class="form-group has-feedback">
                            <label for="ChngPass-OldPass">Old Password</label>
                            <input type="password" class="form-control"
                                id="ChngPass-OldPass"
                                placeholder="Enter your old password"> <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="ChngPass-NewPass">New Password</label>
                            <input type="password" class="form-control"
                                id="ChngPass-NewPass"
                                placeholder="Enter your new password"> <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="ChngPass-ConfNewPass">Confirm
                                New Password</label> <input
                                type="password" class="form-control"
                                id="ChngPass-ConfNewPass"
                                placeholder="Confirm your new password">
                            <span
                                class="glyphicon form-control-feedback"></span>
                        </div>
                        <div class="">
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