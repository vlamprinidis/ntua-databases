<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<p><span class="error">* required field.</span></p>
<?php					
		$stIDErr = $startErr = $posErr = "";
		$ok = 1;
		$stID = $start = $pos = "";
		session_start();
		$irs = $_SESSION['irs'];
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["stID"])) {
				$stIDErr = "Store ID is required";
				$ok = 0;
			}
			else{
				$stID = test_input($_POST["stID"]);
			}
			if (empty($_POST["start"])) {
				$startErr = "Start date is required";
				$ok = 0;
			}
			else{
				$start = test_input($_POST["start"]);
			}
			if (empty($_POST["pos"])) {
				$posErr = "Position is required";
				$ok = 0;
			}
			else{
				$pos = test_input($_POST["pos"]);
			}
			
			if($ok == 1){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";
				$sql="INSERT INTO `works` (`IRS Number`,`StoreID`,`Start Date`, `Position`)
				VALUES ('".$irs."', '".$_POST['stID']."', '".$_POST['start']."', '".$_POST['pos']."')";
				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				if (mysqli_query($conn, $sql)) {
					echo "<th> Record inserted successfully </th>";
					echo "<script>alert('Record inserted successfully')</script>";
					
					echo "<script>window.location.href = 'employee_correct.php'</script>";
				} else {
					echo "<script>alert('Error inserting record: ')</script>";
					echo "Error inserting record: " . mysqli_error($conn);
					echo "<script>window.location.href = 'emp_insert_works.php'</script>";
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
				echo "<strong>Your IRS Number: ".$irs."</strong>";
				echo "<table>";
				echo "<tr><td>Store ID: </td> <td><input type='text' name='stID' value='".$stID."'></td><td><span class='error'>* ".$stIDErr."</span></td></tr>";
				echo "<tr><td>Start Date: </td> <td><input type='date' name='start' value='".$start."'></td><td><span class='error'>* ".$startErr."</span></td></tr>";
				echo "<tr><td>Position: </td> <td><input type='text' name='pos' value='".$pos."'></td><td><span class='error'>* ".$posErr."</span></td></tr>"; 
				echo "</table>";	
			?>	
				<input type="submit" value="Insert">
</form>

<button onclick="window.location.href = 'employee_correct.php'">Abort</button>

</body>
</html> 