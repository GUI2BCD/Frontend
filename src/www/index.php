<?php /*Include .PHP files here. */ ?>

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

      <!-- Link stylesheets here. -->
      <link rel="stylesheet" type="text/css" media="all" href="./css/template.css" />
      <link rel="stylesheet" type="text/css" media="all" href="./css/servicebar.css" />
      
  </head>
  <body class="homepage">
  
    <div id="service">
     	<div id="service-content">
     		<div id="service-left">
     		  <img src="./images/icon.png" alt="Icon">
     		</div>
     		<div id="service-right">
	     		<input class="service-login" type="text" placeholder="username" form="login" required="required">
  	   		<input class="service-login" type="password" placeholder="password" form="login" required="required">
  	   		<button type="submit" form="login">Log In</button>
  	   		<a href="#">Sign-up</a>
     		</div>
     	</div>
    </div>
    
    <div id="wrapper">
      <div id="header">
      </div>
      <div id="content">
      </div>
      <div id="footer">
      </div>
    </div>
  </body>
</html>