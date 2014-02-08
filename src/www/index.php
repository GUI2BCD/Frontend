<?php /*Include .PHP files here. */ 
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

      <!-- Link stylesheets here. -->
      <link rel="stylesheet" type="text/css" media="all" href="./css/template.css" />
      <link rel="stylesheet" type="text/css" media="all" href="./css/servicebar.css" />
      
  </head>
  <body class="homepage">
  
    <div id="service">
     	<div id="service-content">
     	  <?php $servicebar = new servicebar(); ?>
     	</div>
    </div>
    <div id="wrapper">
      <div id="header">
      </div>
      <div id="content">
      </div>
      <div id="footer">
        <p><center>This is filler text to get an idea of where the footer will render. </center></p>
      </div>
    </div>
  </body>
</html>