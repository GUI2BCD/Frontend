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
 * Description: Generates the Agent Page. Will be called when the user
 *              navigates to the "Agent" page once they have logged in.
 *              
 *              The agent page will help the user setup a device on their
 *              account and walk them through the agent install.
 */
namespace LastResortRecovery
{
    class addDevice
    {
        public function __construct()
        {
            return addDevice::generatePage();
        }
        
        private function generatePage()
        {
            ?>
            <div class="tab-pane" id="help">
            <br>
            <div class="panel panel-default">
            <div class="panel-heading">Linux Instructions</div>
                <div class="panel-body">
                <ol>
                    <!-- Download link is legit now. -->
                    <li>Download <a href="download/lastresortrecovery-0.2beta-1-x86_64.pkg.tar.xz">Package file</a></li>
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <a href="images/step1.png" class="thumbnail">
                                <img src="images/step1.png" alt="Step1">
                            </a>
                        </div>
                    </div>
                    <li>Install the package file with the following:<br>
                        <kbd>sudo pacman -U *.pkg.tar.xz</kbd>
                    </li>
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <a href="images/step2.png" class="thumbnail">
                                <img src="images/step2.png" alt="Step2">
                            </a>
                        </div>
                    </div>
                    <li>Run the agent:<br>
                        <kbd>lastresortagent</kbd>
                    </li>
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <a href="images/step3.png" class="thumbnail">
                                <img src="images/step3.png" alt="Step3">
                            </a>
                        </div>
                    </div>
                    <li>Follow application instructions.</li>
                </ol>
                </div>
            </div>
            </div>
            <?php
            return 1;
        }
    }
}