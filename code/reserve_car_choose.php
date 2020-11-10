<html>
	<head>
	</head>
	<body>
		
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="choose">
			<?php
					$custID = "";
					$enddate = "";
					$startdate ="";
					
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select `storeID`, `City`, `Street`,`Street Number` from store");
					
					echo "Choose pickup store: ";
					echo "<select name='storepick'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
						$store1 = $row['storeID'];
						echo '<option value="'.$store1.'">'.$row['City'].', '.$row['Street'].' '.$row['Street Number'].'</option>';
					}

					echo "</select><br>";
					
					$result = $conn->query("select `storeID`, `City`, `Street`,`Street Number` from store");
					
					echo "Choose arrival store: ";
					echo "<select name='storeleave'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
						$store2 = $row['storeID'];
						echo '<option value="'.$store2.'">'.$row['City'].', '.$row['Street'].' '.$row['Street Number'].'</option>';
					}

					echo "</select><br>";
					
					$result = $conn->query("select `storeID`, `City`, `Street`,`Street Number` from store");
					
					echo "Choose pickup date: ";
					echo "<input type='date' name='star' value='".$startdate."'><br>";
				
					echo "Choose leave date: ";
					echo "<input type='date' name='fin' value='".$enddate."'><br>";
				
					
					echo "Give your username (If you don't have one, abort): <input type='text' name='cust' value='".$custID."'><br>";
					
			?>
				<input type="submit" name="formSubmitdel" value="Submit" />
		</form>
		
			<?php
			
			session_start();
			$car = $_SESSION['car'];
			$ok = 1;
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				
				if (empty($_POST["cust"])) {
					echo "<script>alert('Enter username!')</script>";
					$ok = 0;
				}
				else{
					$custID = $_POST["cust"];
				}
				if(isset($_POST['storepick']))
				{
					$store1 = $_POST['storepick'];
					if($store1 != 'tpt'){
						;
					}
					else {
						$ok = 0;
						echo "<script>alert('Insert pickup store')</script>";
					}
				}
				if(isset($_POST['storeleave']))
				{
					$store2 = $_POST['storeleave'];
					if($store2 != 'tpt'){
						;
					}
					else {
						$ok = 0;
						echo "<script>alert('Insert drop store')</script>";
					}
				}
				
				if (empty($_POST["star"])){
					$ok = 0;
					echo "<script>alert('Enter start date')</script>";
				}
				else{
					$startdate = $_POST["star"];
				}
				
				if (empty($_POST["fin"])){
					$ok = 0;
					echo $enddate;
					echo "<script>alert('Enter end date')</script>";
				}
				else{
					$enddate = $_POST["fin"];
				}
				if($ok == 1){
					
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select `City` from store where `storeID` = '$store1'");
					$row = $result->fetch_assoc();
					$cit1 = $row['City'];
					
					$result = $conn->query("select `City` from store where `storeID` = '$store2'");
					$row = $result->fetch_assoc();
					$cit2 = $row['City'];
					
					$sql="INSERT INTO `reserves` (`License Plate`, `Start Date`, `Start Location`, `Finish Location`, `Finish Date`, `Paid`, `Customer ID`)
					VALUES ('".$car."', '".$startdate."', '".$cit1."', '".$cit2."', '".$enddate."',0 , '".$custID."')";
					
					if (mysqli_query($conn, $sql)) {
						echo "<th> Reservation successfull </th>";
						echo "<script>alert('Reservation successfull')</script>";
				?>	<script>		window.location.href = "reserve.php"	</script>	<?php 
					} else {
						echo "Error inserting record: " . mysqli_error($conn);
						echo "<script>alert('Reservation failed, choose something else')</script>";
						?>	<script>		window.location.href = "reserve_car.php"	</script>	<?php 
					}
						
						
					
				}
				
			}
		?>
		
	</body>
</html> 