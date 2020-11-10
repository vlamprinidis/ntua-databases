<!DOCTYPE html>
<html>
<head>

	</head>
    <body>
	
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$conn = new mysqli('localhost', 'root', '', 'mydatabase') ;	
			session_start();
			$_SESSION['ID']=$_POST["ID"];
			$IRS=$_POST["IRS"];	
			$UserName=$_POST["ID"];	
			$_SESSION['ID']=$UserName;
			$sql= "SELECT * FROM `customer` WHERE `IRS Number`='".$IRS."' AND `Customer ID` = '".$UserName."' ";
			//$total=mysqli_query($conn,$sql);
			//if( mysqli_query($conn,$sql)){echo "hey";}
			$res = mysqli_query($conn,$sql);
			if(!( (mysqli_num_rows($res)) > 0 ))  {
				?>
			   <script type="text/javascript">
					alert("Wrong identification!");
					window.location.href="client.php"; 
			   </script> <?php
			}
			else{
				?> <script> window.location.href="reserve.php"; </script> <?php
			}
		}
		?>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		
			<p>Enter your Username and IRS Number to sign in:<p>
			<?php
			echo "<table>";
				echo "<tr><td>Username:</td> <td><input type='text' name='ID'></td></tr>";
				echo "<tr><td>IRS Number:</td> <td><input type='text' name='IRS'></td></tr>";				
				echo "</table>";
				echo "<input type='submit' value='OK'>"; 
				
			?>
		</form>
	</body>
</html>