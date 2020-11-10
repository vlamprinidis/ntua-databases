<!DOCTYPE html>
<html>
    <body>
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		<?php
			session_start();
			$Id=$_SESSION['ID']; 
		?>
		<form action="">
			 <input type="button" value="Update Account" onclick="window.location.href='updatecl.php';"/>
			 <input type="button" value="Delete Account" onclick="window.location.href='deletecl.php';"/>
			 <input type="button" value="Make Reservation" onclick="window.location.href='makeres.php';"/>
			<?php $_SESSION['ID']=$Id; ?>
    </form> 
	</body>
</html>
