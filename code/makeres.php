<!DOCTYPE html>
<html>
	<head>
	
	</head>
	<body>
	<button class="homebutton" onClick="window.location = 'client.php'" >Logout</button>
		<?php session_start(); 
		$Id=$_SESSION['ID']; 
		$_SESSION['ID']=$Id;
		
			  ?>
		<input type="button" value="Reserve a car" onclick="window.location.href='reserve_car.php';"/>
		<input type="button" value="Update reservations" onclick="window.location.href='update_car_sel.php';"/>
		<input type="button" value="Delete Reservation" onclick="window.location.href='delete_car_correct.php';"/>
		<br><br>
		
		<?php		
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";
				
				class TableRows extends RecursiveIteratorIterator { 
					function __construct($it) { 
						parent::__construct($it, self::LEAVES_ONLY); 
					}

					function current() {
						return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
					}

					function beginChildren() { 
						echo "<tr>"; 
					} 

					function endChildren() { 
						echo "</tr>" . "\n";
					} 
				}

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT `Start Date`, `Start Location`,`Finish Location` FROM reserves WHERE `Customer ID` = '$Id' order by `Start Date` "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
					
					echo "<table>";
					echo "<tr><th>Start Date</th><th>Pick up at</th><th>Return to</th></tr>";
					//echo "<table style='border: solid 1px black;'>";

					foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
						echo $v;
					}
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
				echo "</table>";
				
				
				
		?>
	</body>
</html> 