<?php

  require_once('secthemall-webapp-client/functions.php');

?>
<html>
  <head>
    <title>My WebApp</title>
  </head>
  <body>
  
     <?php
     
      secthemall_sendlog(array(
        'msg' => 'Hello World!',
        'severity' => 'low'
      ));
      
     ?>
     
  </body>
</html>
