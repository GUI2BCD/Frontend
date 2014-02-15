<?php 
/* Include .PHP files here. */
namespace LastResortRecovery;

include './LRR/servicebar.php';
?>

<html>
<head>
<meta charset="UTF-8">
<!--
        University of Massachusetts Lowell
        GUI Programming II, Prof. Jesse Heines
		
        Senior Project: Last Resort Recovery
        Authors - David Jelley, Jr.
                  Cameron Morris
                  Benjamin Cao

        Description: This semester we are tasked to take the knowledge we learned in GUI I and spend 
                     the entire semester developing an interesting, advanced, and professional webpage.

        Version 0.01
      -->

<!-- Link local stylesheets and jQuery here. -->
<link rel="stylesheet" type="text/css" media="all"
  href="./css/template.css" />
<link rel="stylesheet" type="text/css" media="all"
  href="./css/public.css" />
<link rel="stylesheet" type="text/css" media="all"
  href="./css/servicebar.css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>   
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="./js/validation.js"></script>
<script src="./js/login.js"></script>

<!-- Link jQuery UI here. -->
<link rel="stylesheet" type="text/css" media="all"
  href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

</head>
<body class="homepage">
  <!-- Dialog Box Div -->
  <div id="login-prompt" title="Sign in">
    <form>
      <fieldset>
        <label for="login-username">Username:</label><br /> <input
          type="text" name="login-username" id="login-username"
          class="text ui-widget-content ui-corner-all"><br /> <label
          for="login-password">Password:</label><br /> <input
          type="password" name="login-password" id="login-password"
          class="text ui-widget-content ui-corner-all">
      </fieldset>
    </form>
  </div>

  <div id="service">
    <div id="service-content">
     	  <?php $servicebar = new Servicebar(); ?>
     	</div>
  </div>
  <div id="wrapper">
    <div id="header">
      <form name="reg" id="reg" method="get">
        <p>
          <input type="text" name="username" id="signup-username"
            placeholder="Pick a username"
            class="text ui-widget-content ui-corner-all">
        </p>
        <p>
          <input type="text" name="email" id="signup-email"
            placeholder="Your email"
            class="text ui-widget-content ui-corner-all">
        </p>
        <p>
          <input type="password" name="password" id="signup-password"
            placeholder="Create a password"
            class="text ui-widget-content ui-corner-all">
        </p>
        <p>
          <input type="password" name="password2" id="signup-password2"
            placeholder="Verify your password"
            class="text ui-widget-content ui-corner-all">
        </p>
        <p>
          <input type="button" name="newuser-submit" id="signup-submit"
            value="Sign up now!">
        </p>
      </form>
    </div>
    <div id="content">
      <div class="content-image-left"></div>
      <div class="content-image-right"></div>
      <div class="content-image-left"></div>
      <div class="content-image-right"></div>
    </div>
    <div id="footer"></div>
  </div>
</body>
</html>
