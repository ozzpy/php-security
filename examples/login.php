<?php
  session_start();
  require_once('secthemall-webapp-client/functions.php');

?>
<html>
<head>
<title>My Second Webapp</title>
</head>
<body>

  <?php

    if(isset($_POST['username']) && $_POST['username'] == 'admin' && $_POST['password'] == 'iloveyou') {

      secthemall_sendlog(array(
        'msg' => 'my webapp: Login OK!',
        'username' => $_POST['username'],
        'severity' => 'low'
      ));

      echo '<center class="container">  <h3>Hi admin!</h3>   </center>';

    } else {

      if(isset($_POST['username']) && ($_POST['username'] != 'admin' || $_POST['password'] != 'iloveyou')) {
      
        secthemall_sendlog(array(
          'msg' => 'my webapp: Login failed',
          'username' => $_POST['username'],
          'severity' => 'high'
        ));
        
        echo '<center class="container">  <h3>login failed.</h3>   </center>';
        
      }
  ?>
  
	<center class="container">
		<h2>My Second Webapp</h2>
		<form method="post">
			<?php echo date('M jS H:i:s')."<br />"; ?>
			<input type="text" placeholder="Username" name="username" autocomplete="off" /><br />
			<input type="password" placeholder="Password" name="password" autocomplete="off" /><br />
			<input class="btn red" type="submit" value="Login" />
		</form>
	</center>
  
  <?php
  
    }
    
  ?>
 
</body>
</html>
