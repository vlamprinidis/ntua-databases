<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
<?php	
		session_start();
		$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
		or die ('Cannot connect to db');
		$Id=$_SESSION['ID']; 
				
				$result = mysqli_query($conn, "SELECT * FROM `customer` WHERE `Customer ID`='$Id'");
				$row = mysqli_fetch_assoc($result);
		?>
		<form action="client_temp.php" method="post">
			<?php			
				echo "<table>";
				echo "<tr><td>SSN:</td> <td><input type='text' name='SSN' value='".$row["Social Security Number"]."'></td></tr>";
				echo "<tr><td>License:</td> <td><input type='text' name='License' value='".$row["Driver's License"]."'></td></tr>";
				echo "<tr><td>First Name:</td> <td><input type='text' name='FirstName' value='".$row["First Name"]."'></td></tr>";
				echo "<tr><td>Last Name:</td> <td><input type='text' name='LastName' value='".$row["Last Name"]."'></td></tr>";
				echo "<tr><td>Street:</td> <td><input type='text' name='Street' value='".$row["Street"]."'></td></tr>";
				echo "<tr><td>Street Number:</td> <td><input type='text' name='StreetNumber' value='".$row["Street Number"]."'></td></tr>";
				echo "<tr><td>Postal Code:</td> <td><input type='text' name='PostalCode' value='".$row["Postal Code"]."'></td></tr>";
				echo "<tr><td>City:</td> <td><input type='text' name='City' value='".$row["City"]."'></td></tr>";
				echo "</table>";
					
				echo "<input type='submit' value='Update'>";
						
				$_SESSION['ID']=$Id;
		?>
		</form>
		
	</body>
</html> 