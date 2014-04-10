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
                    <!-- Download link isn't actually for real. Just filler. -->
                    <li>Download <a href="download/lastresortrecovery-0.2beta-1-x86_64.pkg.tar.xz">Package file</a></li>
                    <li>Install the package file with the following:<br>
                        <kbd>sudo pacman -U *.pkg.tar.xz</kbd>
                    </li>
                    <li>Run the agent:<br>
                        <kbd>lastresortagent</kbd>
                    </li>
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