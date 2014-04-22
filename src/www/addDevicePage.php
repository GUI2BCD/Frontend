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
<div class="page-space">
	<div class="panel panel-default panel-primary">
		<div class="panel-heading">Setup Instructions</div>
		<div id="rootwizard">
			<div class="navbar instructnav">
				<div class="navbar-inner">
					<div class="container">
						<ul>
							<li><a href="#tab1" data-toggle="tab">Download</a></li>
							<li><a href="#tab2" data-toggle="tab">Install</a></li>
							<li><a href="#tab3" data-toggle="tab">Setup</a></li>
							<li><a href="#tab4" data-toggle="tab">Done</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="tab-content instructions">
				<div class="tab-pane" id="tab1">
					<div class="alert alert-info alerthelp">
						<strong>Download</strong> the appropriate package for your
						operating system:
					</div>
					<div class="well well-lg alerthelp">
						<div class="row helprow">
							<div class="col-md-3">
								<div class="row">
									<img alt="Ubuntu/Debian" src="images/deb.svg">
								</div>
								<div class="row">
									<strong>Ubuntu/Debian</strong>
								</div>
								<div class="row">
								    <a href="download/lastresortrecovery_0.2-beta.deb">
									   <button type="button" class="btn btn-default">Download</button>
								    </a>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<img alt="ArchLinux" src="images/arch.svg">
								</div>
								<div class="row">
									<strong>Arch Linux</strong>
								</div>
								<div class="row">
								    <a href="download/lastresortrecovery-0.2beta-1-x86_64.pkg.tar.xz">
									   <button type="button" class="btn btn-default">Download</button>
									</a>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<img alt="osx" src="images/osx.svg">
								</div>
								<div class="row">
									<strong>Mac OSX</strong>
								</div>
								<div class="row">
									<button type="button" class="btn btn-default" disabled>Coming Soon</button>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<img alt="Windows" src="images/win.svg">
								</div>
								<div class="row">
									<strong>Windows</strong>
								</div>
								<div class="row">
									<button type="button" class="btn btn-default" disabled>Coming soon</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="tab-pane" id="tab2">
					<div class="alert alert-info alerthelp">
						<strong>Install</strong> the package for your operating system:
					</div>
					<div class="well well-lg alerthelp">
						<div class="row">
							<div class="col-md-2 helprow">
								<div class="row">
									<img alt="Ubuntu/Debian" src="images/deb.svg">
								</div>
								<div class="row">
									<strong>Ubuntu/Debian</strong>
								</div>
							</div>
							<div class="col-md-10">
								<div class="row">Install with software center or through command
									line:</div>
								<div class="row">
									<kbd>sudo dpkg -i lastresortrecovery-0.2beta.deb</kbd>
								</div>
								<div class="row">Resolve dependencies:</div>
								<div class="row">
									<kbd>sudo apt-get install -f</kbd>
								</div>
							</div>
						</div>
					</div>
					<div class="well well-lg alerthelp">
						<div class="row">
							<div class="col-md-2 helprow">
								<div class="row">
									<img alt="ArchLinux" src="images/arch.svg">
								</div>
								<div class="row">
									<strong>Arch Linux</strong>
								</div>
							</div>
							<div class="col-md-10">
								<div class="row">Install through command line:</div>
								<div class="row">
									<kbd>sudo pacman -U
										lastresortrecovery-0.2beta-1-x86_64.pkg.tar.gz</kbd>
								</div>
							</div>

						</div>

					</div>
				</div>
				<div class="tab-pane" id="tab3">
					<div class="alert alert-info alerthelp">
						<strong>Setup</strong> the agent:
					</div>
					<div class="well well-lg alerthelp">
						Start the agent with the following command:<br>
						<kbd>sudo lastresortagent</kbd>
						<br>
					</div>
					<div class="well well-lg alerthelp">
						Follow the prompts to configure the agent with your account<br>
					</div>
				</div>
				<div class="tab-pane" id="tab4">
					<div class="alert alert-info alerthelp">
						<strong>Done!</strong>
					</div>
					<div class="well well-lg">
						All done! You're device is now ready. Select the device from the
						dashboard to view it.<br>
					</div>
				</div>
				<ul class="pager wizard">
					<li class="previous first" style="display: none;"><a href="#">First</a></li>
					<li class="previous"><a href="#">Previous</a></li>
					<li class="next last" style="display: none;"><a href="#">Last</a></li>
					<li class="next"><a href="#">Next</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
<?php
            return 1;
        }
    }
}