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
		$data_date = $_SESSION['date'];
		$data_lic = $_SESSION['lic'];
		$_SESSION['ID'] = $Id;
		$_SESSION['date'] = $data_date;
		$_SESSION['lic'] = $data_lic;
				
				$result = mysqli_query($conn, "select * from reserves where `Customer ID`='".$Id."' AND `Start Date` = '".$data_date."' AND `License Plate`='".$data_lic."'  ");
				$row = mysqli_fetch_assoc($result);
		?>
		<form action="car_temp.php" method="post">
			<?php			
				echo "<table>";
				echo "<tr><td>Start Date: </td> <td><input type='date' name='startD' value='".$row["Start Date"]."'></td></tr>";
				echo "<tr><td>Start location: </td> <td><input type='text' name='startL' value='".$row["Start Location"]."'></td></tr>";
				echo "<tr><td>Finish Date:</td> <td><input type='date' name='finD' value='".$row["Finish Date"]."'></td></tr>";
				echo "<tr><td>Finish Location:</td> <td><input type='text' name='finL' value='".$row["Finish Location"]."'></td></tr>";
				echo "<tr><td>License Plate:</td> <td><input type='text' readonly name='lic' value='".$row["License Plate"]."'></td></tr>";
				echo "</table>";
					
				echo "<input type='submit' value='Update'>";
						
				$_SESSION['ID'] = $Id;
		$_SESSION['date'] = $data_date;
		$_SESSION['lic'] = $data_lic;
		?>
		</form>
		
	</body>
</html> 