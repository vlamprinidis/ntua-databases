<html>
	<head>
	</head>
	<body>
		<?php
			$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
			or die ('Cannot connect to db');
			$varPerson = $_POST["update"];
				
			if($varPerson != 'tpt'){
				$result = mysqli_query($conn, "SELECT * FROM `upd_view` WHERE `IRS Number`=$varPerson");
				$row = mysqli_fetch_assoc($result);
		?>
		<form action="admin_tempview.php" method="post">
			<?php			
				echo "<table>";
				echo "<tr><td>IRS Number:</td> <td>$varPerson</td> </tr>";
				echo "<tr><td>SSN:</td> <td><input type='text' name='SSN' value='".$row["Social Security Number"]."'></td></tr>";
				echo "<tr><td>License:</td> <td><input type='text' name='License' value='".$row["Driver's License"]."'></td></tr>";
				echo "<tr><td>First Name:</td> <td><input type='text' name='FirstName' value='".$row["First Name"]."'></td></tr>";
				echo "<tr><td>Last Name:</td> <td><input type='text' name='LastName' value='".$row["Last Name"]."'></td></tr>";
				echo "<tr><td>City:</td> <td><input type='text' name='City' value='".$row["City"]."'></td></tr>";
				echo "</table>";
					
				echo "<input type='submit' value='Update'>";
						
				session_start();
				$_SESSION['IRS']=$varPerson;
			}
		?>
		</form>
		
	</body>
</html> 