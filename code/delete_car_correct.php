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
					$result = $conn->query("select `Start Date`,`License Plate` from reserves where `Customer ID`='$Id' ");
					
					echo "<select name=delete>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
						echo "geia";
								  $start = $row['Start Date'];
								  $lic = $row['License Plate'];
								  echo '<option value="'.$start.'*'.$lic.'">'.$start.' '.$lic.'</option>';
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
				$varPerson = $_POST['delete'];
				if($varPerson != 'tpt'){
					// split the contents of $_POST['data'] on a hyphen, returning at most two items
					list($data_date, $data_lic) = explode("*", $_POST['delete'], 2);
					$conn->query("DELETE FROM `reserves` WHERE `Customer ID`='".$Id."' AND `License Plate`='".$data_lic."' AND `Start Date`='".$data_date."' " );
					echo "<script>alert('Record deleted successfully')</script>";
					echo "<script>window.location.href='reserve.php'</script>";
				}
			}
		?>
</body>
</html>