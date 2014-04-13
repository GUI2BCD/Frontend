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
                    <div id="rootwizard">
                        <div class="navbar">
	                        <div class="navbar-inner">
	                            <div class="container">
	                                <ul>
	  	                                <li><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                        <li><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                        <li><a href="#tab3" data-toggle="tab">Step 3</a></li>
                                        <li><a href="#tab4" data-toggle="tab">Step 4</a></li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                    
	                    <div class="tab-content">
	                        <div class="tab-pane" id="tab1">
                                <!-- Download link is legit now. -->
                                Download <a href="download/lastresortrecovery-0.2beta-1-x86_64.pkg.tar.xz">Package file</a>
                                <div class="row">
                                    <div class="col-xs-6 col-md-3">
                                        <a href="images/step1.png" class="thumbnail">
                                            <img src="images/step1.png" alt="Step1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                Install the package file with the following:<br>
                                <kbd>sudo pacman -U *.pkg.tar.xz</kbd>
                                <div class="row">
                                    <div class="col-xs-6 col-md-3">
                                        <a href="images/step2.png" class="thumbnail">
                                            <img src="images/step2.png" alt="Step2">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                Run the agent:<br>
                                <kbd>lastresortagent</kbd>
                                <div class="row">
                                    <div class="col-xs-6 col-md-3">
                                        <a href="images/step3.png" class="thumbnail">
                                            <img src="images/step3.png" alt="Step3">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4">
                                Follow application instructions.
                            </div>
        
		                    <ul class="pager wizard">
			                    <li class="previous first"><a href="javascript:;">First</a></li>
			                    <li class="previous"><a href="javascript:;">Previous</a></li>
			                    <li class="next last"><a href="javascript:;">Last</a></li>
		  	                    <li class="next"><a href="javascript:;">Next</a></li>
			                    <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
		                    </ul>
	                    </div>	
                    </div>
                </div>
            </div>
            <?php
            return 1;
        }
    }
}