<?php
session_start();
session_destroy();
echo "<script>
		alert('Successfully Logged out')
		location.replace('login.php');
	  </script>";
?>