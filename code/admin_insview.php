<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<p><span class="error">* required field.</span></p>
<?php					
	$IRSErr = $SSNErr = $LisErr = $FnErr = $LnErr = $CityErr = "";
	$ok = 1;
	$irs = $ssn = $lic = $fn = $ln = $city = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["IRS"])) {
			$IRSErr = "IRS is required";
			$ok = 0;
		}
		else{
			$irs = test_input($_POST["IRS"]);
		}
		if (empty($_POST["SSN"])) {
			$SSNErr = "Social Security Number is required";
			$ok = 0;
		}
		else{
			$ssn = test_input($_POST["SSN"]);
		}
		if (empty($_POST["License"])) {
			$LisErr = "License code is required";
			$ok = 0;
		}
		else{
			$lic = test_input($_POST["License"]);
		}
		if (empty($_POST["FirstName"])) {
			$FnErr = "First name is required";
			$ok = 0;
		}
		else{
			$fn = test_input($_POST["FirstName"]);
		}
		if (empty($_POST["LastName"])) {
			$LnErr = "Last name is required";
			$ok = 0;
		}
		else{
			$ln = test_input($_POST["LastName"]);
		}
		if (empty($_POST["City"])) {
			$CityErr = "City is required";
			$ok = 0;
		}
		else{
			$city = test_input($_POST["City"]);
		}
		
		if($ok == 1){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "mydatabase";
			$sql="INSERT INTO `upd_view` (`IRS Number`, `Social Security Number`, `Driver's License`, `First Name`, `Last Name`, `City`)
			VALUES ('".$_POST['IRS']."', '".$_POST['SSN']."', '".$_POST['License']."', '".$_POST['FirstName']."', '".$_POST['LastName']."', '".$_POST['City']."')";
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			if (mysqli_query($conn, $sql)) {
				echo "<th> Record inserted successfully </th>";
				echo "<script>alert('Record inserted successfully')</script>";
				//session_start();
				//$_SESSION['irs'] = $irs;
?>	<script>	window.location.href = "admin_correct.php"	</script>	<?php 
			} else {
				echo "<script>alert('Error inserting record: ')</script>";
				echo "Error inserting record: " . mysqli_error($conn);
			}
			mysqli_close($conn);
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>	
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	<?php
		echo "<table>";
		echo "<tr><td>IRS Number:</td> <td><input type='text' name='IRS' value='".$irs."'></td><td><span class='error'>* ".$IRSErr."</span></td></tr>";
		echo "<tr><td>SSN:</td> <td><input type='text' name='SSN' value='".$ssn."'></td><td><span class='error'>* ".$SSNErr."</span></td></tr>";
		echo "<tr><td>License:</td> <td><input type='text' name='License' value='".$lic."'></td><td><span class='error'>* ".$LisErr."</span></td></tr>"; 
		echo "<tr><td>First Name:</td> <td><input type='text' name='FirstName' value='".$fn."'><td><span class='error'>* ".$FnErr."</span></td></tr>";
		echo "<tr><td>Last Name:</td> <td><input type='text' name='LastName' value='".$ln."'></td><td><span class='error'>* ".$LnErr."</span></td></tr>";
		echo "<tr><td>City:</td> <td><input type='text' name='City' value='".$city."'></td><td><span class='error'>* ".$CityErr."</span></td></tr>";
		echo "</table>";	
	?>				
	<input type="submit" value="Insert">
</form>

<button onclick="window.location.href = 'admin_correct.php'">Abort</button>
		
</body>
</html> 