<html>
	<head>
	</head>
	<body>
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		<?php
			session_start();
			$Id=$_SESSION['ID']; 
			$conn = new mysqli('localhost', 'root', '', 'mydatabase') ;
			$_SESSION['ID'] = $Id; 
			
			if(empty($_POST['SSN'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['License'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['FirstName'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['LastName'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['Street'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['StreetNumber'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['PostalCode'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['City'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			
			$sql="UPDATE `customer` SET `Social Security Number`='".$_POST['SSN']."', `Driver's License`='".$_POST['License']."', `First Name`='".$_POST['FirstName']."', 
				`Last Name`='".$_POST['LastName']."', `Street`='".$_POST['Street']."', `Street Number`='".$_POST['StreetNumber']."', 
				`Postal Code`='".$_POST['PostalCode']."', `City`='".$_POST['City']."' WHERE `Customer ID`='".$Id."'";

			if($result=mysqli_query($conn,$sql)){
				?><script>alert("Update completed successfully");</script><?php
			}
			else {
				?><script>alert("Update unsuccessfull");</script> <?php
			}
			?> <script> window.location.href ="reserve.php" </script> <?php	
		?>
	</body>
</html> 