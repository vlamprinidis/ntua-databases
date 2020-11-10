<!DOCTYPE html>
<html>
    <body>
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		<?php
			session_start();
			$Id=$_SESSION['ID']; 
			
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$conn->query("DELETE FROM `customer` WHERE `Customer ID`='$Id' ");
					?> <script> alert("Account deleted!"); window.location.href="client.php"; </script> 
	</body>
</html>

	 
					