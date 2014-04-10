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

        public function __construct()
        {
            return accountPage::generatePage();
        }

        private function generatePage()
        {
            ?>
            <div class="tab-pane" id="account">
                <br /> This page is currently under construction.
            </div>
            <?php
        }
    }
}