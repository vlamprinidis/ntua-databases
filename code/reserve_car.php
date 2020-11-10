<html>
	<head>
		<p>Select your desired car</p>
	</head>
	<body>
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<?php
	 
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select * from vehicle order by Make");
					
					echo "<select name='cars'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
								  $id = $row['License Plate'];
								  $model = $row['Model'];
								  $type = $row['Type'];
								  $make = $row['Make']; 
								  $year = $row['Year']; 
								  $km = $row['Kilometers']; 
								  $cc = $row['Cylinder Capacity'];
								  $hp = $row['Horsepower'];
								  $dmg = $row['Damage'];
								  $mlf = $row['Malfunctions'];
								  $NServ = $row['Next Service']; 
								  $insur = $row['Insurance Exp Date']; 
								  $LServ = $row['Last Service']; 
								  $stID = $row['Store ID'];
								  echo '<option value="'.$id.'">'.$make.' '.$model.', Type: '.$type.',Year: '.$year.',km: '.$km.',HP: '.$hp.',CC: '.$cc.'</option>';
					}

					echo "</select>";
			?>
				<input type="submit" name="Car select" value="Pick">
		</form>
		<?php
			if(isset($_POST['cars']))
			{
				$car = $_POST['cars'];
				if($car != 'tpt'){
					session_start();
					$_SESSION['car'] = $car;
					?>   <script>	window.location.href = "reserve_car_choose.php";	</script>	<?php
				}
			}
		?>		
		
	</body>
</html> 