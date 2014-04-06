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
            <?php
            return 1;
        }
    }
}