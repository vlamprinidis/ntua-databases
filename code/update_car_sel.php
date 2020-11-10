<html>
<head>
</head>
<body>
<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
	<?php 
		
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<?php
					session_start();
					$Id = $_SESSION['ID'];
					$_SESSION['ID']=$Id;
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					$result = $conn->query("select * from reserves where `Customer ID`='$Id' ");
					
					echo "<select name=upd>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
						echo "geia";
								  $start = $row['Start Date'];
								  $lic = $row['License Plate'];
								  echo '<option value="'.$start.'*'.$lic.'">Start date: '.$start.', Plate: '.$lic.'</option>';
					}

					echo "</select>";
			?>
				<input type="submit" name="formSubmitdel" value="Submit" />
		</form>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$Id = $_SESSION['ID'];
				$_SESSION['ID']=$Id;
				$varPerson = $_POST['upd'];
				if($varPerson != 'tpt'){
					// split the contents of $_POST['data'] on a hyphen, returning at most two items
					list($data_date, $data_lic) = explode("*", $_POST['upd'], 2);
					
					$_SESSION['date'] = $data_date;
					$_SESSION['lic'] = $data_lic;
					echo "<script>window.location.href='update_car.php'</script>";
				}
			}
		?>
</body>
</html>