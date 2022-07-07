
<?php
      include "config.php";
      if(!empty($_POST)) {
            
      $name = $_POST['conname'];
      $email = $_POST['conemail'];
      $message = $_POST['conmessage']; 
      mysqli_query($con, "insert into contact_us (name, email, message) values ('$name', '$email', '$message')"); 
      echo '<script type="text/javascript">feedback_submit();</script>';     
      }
?>
