<html>
	<head>
	</head>
	<body>
		<?php
			session_start();
			$Id=$_SESSION['ID']; 
			$data_date = $_SESSION['date'];
			$data_lic = $_SESSION['lic'];
			$_SESSION['ID'] = $Id;
			$_SESSION['date'] = $data_date;
			$_SESSION['lic'] = $data_lic;
			$conn = new mysqli('localhost', 'root', '', 'mydatabase') ;
			
			if(empty($_POST['startD'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['startL'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['finD'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			if(empty($_POST['finL'])){
				echo "<script>alert('Leave nothing empty: ')</script>";
				?>	<script>		window.location.href = "client.php"	</script>	<?php 
			}
			
			$sql="UPDATE `reserves` SET `Start Date`='".$_POST['startD']."', `Start Location`='".$_POST['startL']."', `Finish Date`='".$_POST['finD']."', 
				`Finish Location`='".$_POST['finL']."' WHERE `Customer ID`='".$Id."' AND `Start Date` = '".$_POST['startD']."' AND `License Plate`='".$_POST['lic']."' " ;

			if($result=mysqli_query($conn,$sql)){
				?><script>alert("Update completed successfully");</script><?php
			}
			else {
				?><script>alert("Update unsuccessfull");</script> <?php
			}
			?> <script> window.location.href = "client.php" </script> <?php	
		?>
	</body>
</html> 