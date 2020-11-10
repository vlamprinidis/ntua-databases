<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<p><i>Field 'Username' will be used as an identifier for login</i></p>
<?php					
		$CIdErr = $IrsErr =  $FnErr =$FRegErr = $STRErr =$StrnErr =$PcErr =$CityErr = "";
		$ok = 1;
		$CId = $Irs=$SSN= $Fn =$Ln=$Dlic=$FReg= $STR= $Strn =$Pc =$City = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["ID"])) {
				$CIdErr = "ID is required";
				$ok = 0;
			}
			else{
				$CId = test_input($_POST["ID"]);
			}
			if (empty($_POST["IRS"])) {
				$IrsErr = "IRS is required";
				$ok = 0;
			}
			else{
				$Irs = test_input($_POST["IRS"]);
			}
			if (empty($_POST["FirstName"])) {
				$FnErr = "First Name is required";
				$ok = 0;
			}
			else{
				$Fn = test_input($_POST["FirstName"]);
			}
			if (empty($_POST["FirstName"])) {
				$FnErr = "First name/Company Name is required";
				$ok = 0;
			}
			else{
				$fn = test_input($_POST["FirstName"]);
			}
	/*		if (empty($_POST["Registration"])) {
				$FRegErr = "First Registration is required";
				$ok = 0;
			}
			else{
				$ln = test_input($_POST["Registration"]);
			}*/
			if (empty($_POST["Street"])) {
				$STRErr = "Street name is required";
				$ok = 0;
			}
			else{
				$STR = test_input($_POST["Street"]);
			}
			if (empty($_POST["StreetNumber"])) {
				$StrnErr = "Street number is required";
				$ok = 0;
			}
			else{
				$Strn = test_input($_POST["StreetNumber"]);
			}
			if (empty($_POST["PostalCode"])) {
				$PcErr = "Postal code is required";
				$ok = 0;
			}
			else{
				$Pc = test_input($_POST["PostalCode"]);
			}
			if (empty($_POST["City"])) {
				$CityErr = "City is required";
				$ok = 0;
			}
			else{
				$City = test_input($_POST["City"]);
			}
			
			if($ok == 1){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";
				$date = (string) date("Y-m-d");
				$sql="INSERT INTO `customer` (`Customer ID`, `IRS Number`, `Social Security Number`, `First Name`, `Last Name`,`Driver's License`,`First Registration`, `Street`, `Street Number`, `Postal Code`, `City`)
				VALUES ('".$_POST['ID']."', '".$_POST['IRS']."', '".$_POST['SSN']."', '".$_POST['FirstName']."', '".$_POST['LastName']."', '".$_POST['License']."','".$date."',
				'".$_POST['Street']."', '".$_POST['StreetNumber']."', '".$_POST['PostalCode']."', '".$_POST['City']."')";
				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}
				echo date("Y-m-d");
				if (mysqli_query($conn, $sql)) {
					echo "<th> Registration successful </th>";
					echo "<script>alert('Registration successful!')</script>";
		?>	<script>		window.location.href = "client.php"	</script>	<?php 
				} else {
					echo "<script>alert('Error registering,give another Username! ')</script>";
					echo "Error inserting record: " . mysqli_error($conn);
				}
				mysqli_close($conn);
			}
		}
		function test_input($data) {
			//$data = trim($data);
			//$data = stripslashes($data);
			//$data = htmlspecialchars($data);
			return $data;
		}

?>	
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			<?php
				echo "<table>";
				echo "<tr><td>Username:</td> <td><input type='text' name='ID' value='".$CId."'></td><td><span class='error'>* ".$CIdErr."</span></td></tr>";
				echo "<tr><td>IRS Number:</td> <td><input type='text' name='IRS' value='".$Irs."'></td><td><span class='error'>* ".$IrsErr."</span></td></tr>";
				echo "<tr><td>SSN:</td> <td><input type='text' name='SSN' value='".$SSN."'></td></tr>";
				echo "<tr><td>First Name/Company Name:</td> <td><input type='text' name='FirstName' value='".$Fn."'><td><span class='error'>* ".$FnErr."</span></td></tr>";
				echo "<tr><td>Last Name:</td> <td><input type='text' name='LastName' value='".$Ln."'></td></tr>";
				echo "<tr><td>Driver's License:</td> <td><input type='text' name='License' value='".$Dlic."'></td></tr>"; 
				echo "<tr><td>Street:</td> <td><input type='text' name='Street' value='".$STR."'></td><td><span class='error'>* ".$STRErr."</span></td></tr>";
				echo "<tr><td>Street Number:</td> <td><input type='text' name='StreetNumber' value='".$Strn."'><td><span class='error'>* ".$StrnErr."</span></td></tr>";
				echo "<tr><td>Postal Code:</td> <td><input type='text' name='PostalCode' value='".$Pc."'></td><td><span class='error'>* ".$PcErr."</span></td></tr>";
				echo "<tr><td>City:</td> <td><input type='text' name='City' value='".$City."'></td><td><span class='error'>* ".$CityErr."</span></td></tr>";
				echo "</table>";	
			?>				
				<input type="submit" value="Insert">
</form>

<button onclick="window.location.href = 'client.php'">Abort</button>
		
</body>
</html> 