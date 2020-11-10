<html>
	<head>
	</head>
	<body>
		<?php
			session_start();
			$conn = new mysqli('localhost', 'root', '', 'mydatabase') ;
			
			if(empty($_POST['SSN'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['License'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['FirstName'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_update.php"	</script>	<?php 
			}
			if(empty($_POST['LastName'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['Street'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['StreetNumber'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['PostalCode'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			if(empty($_POST['City'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "admin_correct.php"	</script>	<?php 
			}
			
			$sql="UPDATE `employee` SET `Social Security Number`='".$_POST['SSN']."', `Driver's License`='".$_POST['License']."', `First Name`='".$_POST['FirstName']."', 
				`Last Name`='".$_POST['LastName']."', `Street`='".$_POST['Street']."', `Street Number`='".$_POST['StreetNumber']."', 
				`Postal Code`='".$_POST['PostalCode']."', `City`='".$_POST['City']."' WHERE `IRS Number`='".$_SESSION['IRS']."'";

			if($result=mysqli_query($conn,$sql)){
				?><script>alert("Update completed successfully");</script><?php
			}
			else {
				?><script>alert("Update unsuccessfull");</script> <?php
			}
			$redir = "admin_correct.php";
			?> <script> window.location.href = "admin_correct.php" </script> <?php	
		?>
	</body>
</html> 