<?php

class servicebar
{

    function __construct ()
    {
        $this->setServicebar();
    }

    /**
     * This function will set the html for the service bar.
     * The
     * html will vary whether a user is logged in or not.
     */
    private function setServicebar ()
    {
        if(/*$this->checkCookie()*/ true) {
            ?>

    <div id="service-left">
        <a href="./index.php"><img src="./images/icon2.png" alt="Icon"></a>
    </div>
    <div id="service-right">
        <button type="button" class="login-prompt">Log In</button>
    </div>

<?php
        } else {
            echo '<p>Invalid Login</p>';
        }
    }

    /**
     * This function will check the cookies on the current system and
     * see if there is a valid login session.
     *
     * Return true: If there is a current active session. (A user is logged in)
     * Return false: If the session is expired, or no cookie/session was found.
     */
    private function checkCookie ()
    {
    /* Check the cookie for a current session. */
    /* Return true if a user is logged in. */
    /* Return false if no current session is found. */
    }
}
