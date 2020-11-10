<!DOCTYPE html>
<html>
<head>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
    height: 100%;
    margin: 0;
    font-family: Arial;
}

.error {color: #FF0000;}
/* Style tab links */
.tablink {
    background-color: #d9d9d9;
    color: black;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
}

.tablink:hover {
    background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
    color: black;
    display: none;
    padding: 100px 20px;
    height: 100%;
}

.homebutton{
	background-color: #d9d9d9;
    color: black;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 10%;
	border-radius: 50%;
	border: 2px solid #d9d9d9;
	position: fixed;
    top: 0%;
	left: 90%;
}

.homebutton:hover {
    background-color: #990000;
}

#Cars {background-color: white;}
#Employees {background-color: white;}
#Clients {background-color: white;}
#Stores {background-color: white;}
</style>
</head>
<body>

<button class="tablink" onclick="openPage('Welcome', this, 'purple','tabcontent','tablink')" >Choose a query!</button>
<button class="tablink" onclick="openPage('View', this, 'yellow','tabcontent','tablink')" >Choose a view!</button>
<button class="homebutton" onClick="window.location = 'code.php'" >Logout</button>
<br><br><br>
<button class="tablink" onclick="openPage('Cars', this, 'red','tabcontent','tablink')">Cars</button>
<button class="tablink" onclick="openPage('Employees', this, 'green','tabcontent','tablink')" id="defaultOpen">Employees</button>
<button class="tablink" onclick="openPage('Clients', this, 'blue','tabcontent','tablink')">Clients</button>
<button class="tablink" onclick="openPage('Stores', this, 'orange','tabcontent','tablink')">Stores</button>

<div id="View" class="tabcontent">
	<style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.querieslink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 50%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.queriescontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}

	#Insert {background-color: white;}
	</style>

	<button class="querieslink" onclick="openPage('view1', this, 'blue','queriescontent','querieslink')">All employees (updatable view)</button>
	<button class="querieslink" onclick="openPage('view2', this, 'blue','queriescontent','querieslink')">Count rents per Store/Location (non-updatable view)</button>
	
	<div id="view1" class="queriescontent">	 
	 
		<button class="emplink" onclick="openPage('showview', this, 'blue','empcontent','emplink')">Show view</button>
		<button class="emplink" onclick="openPage('upd_view', this, 'blue','empcontent','emplink')">Update</button>
		<button class="emplink" onclick="openPage('ins_view', this, 'blue','empcontent','emplink')">Insert</button>
		<button class="emplink" onclick="openPage('del_view', this, 'blue','empcontent','emplink')">Delete</button>
		 
		<div id="showview" class="empcontent">
			<?php				
					echo "<table style='border: solid 1px black;'>";
					echo "<tr><th>IRS Number</th><th>Last Name</th><th>First Name</th><th>City</th></tr>";
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "mydatabase";

					try {
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $conn->prepare("SELECT * FROM upd_view"); 

						$stmt->execute();

						// set the resulting array to associative
						$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		</div>
		 
		<div id="del_view" class="empcontent">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<?php
		 
						$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
						or die ('Cannot connect to db');
						
						$result = $conn->query("SELECT * FROM upd_view");
						
						echo "<select name='delete'>";
						echo "<option value='tpt'>SELECT</option>";
						while ($row = $result->fetch_assoc()) {
									  $id = $row['IRS Number'];
									  $firstname = $row['First Name'];
									  $lastname = $row['Last Name'];
									  echo '<option value="'.$id.'">'.$lastname.' '.$firstname.', IRS: '.$id.'</option>';
					}

						echo "</select>";
				?>
					<input type="submit" name="formSubmitdel" value="Submit" />
			</form>
			<?php
				if(isset($_POST['delete']))
				{
					$varPerson = $_POST['delete'];
					if($varPerson != 'tpt'){
						$conn->query("DELETE FROM `upd_view` WHERE `IRS Number`='$varPerson' ");
						$redir = "admin_delete.php";
					}
				}
			?>
		</div>
		 
		<div id="upd_view" class="empcontent">			
			<form action="admin_updview.php" method="post">
				<?php
		 
						$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
						or die ('Cannot connect to db');
						
						$result = $conn->query("select `IRS Number`, `First Name`,`Last Name` from `upd_view` order by `Last Name`");
						
						echo "<select name='update'>";
						echo "<option value='tpt'>SELECT</option>";
						while ($row = $result->fetch_assoc()) {
									  $id = $row['IRS Number'];
									  $firstname = $row['First Name'];
									  $lastname = $row['Last Name']; 
									  echo '<option value="'.$id.'">'.$lastname.' '.$firstname.', IRS: '.$id.'</option>';
					}

						echo "</select>";
				?>
					<input type="submit" name="formSubmitupd" value="Select" />
			</form>
			
		</div>
		
		<div id="ins_view" class="empcontent">
			<form action="admin_insview.php" method="post">
				<?php
					echo "<table>";
					echo "<tr><td>IRS Number:</td> <td><input type='text' name='IRS' required></td> </tr>";
					echo "<tr><td>First Name:</td> <td><input type='text' name='FirstName' required></td></tr>";
					echo "<tr><td>Last Name:</td> <td><input type='text' name='LastName' required></td></tr>";
					echo "<tr><td>City:</td> <td><input type='text' name='City' required></td></tr>";
					echo "</table>";
						
					echo "<input type='submit' value='Insert'>";
				?>
			</form>
			
		 </div>
	 </div>
	
	<div id="view2" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>City</th><th>Number of Vehicles</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM `nonupd_view`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
	 </div>
</div>

<div id="Welcome" class="tabcontent">
	<style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.querieslink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 50%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.queriescontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}

	#Insert {background-color: white;}
	</style>

	<button class="querieslink" onclick="openPage('show1', this, 'blue','queriescontent','querieslink')">find the names of customers that have reserved motorbikes</button>
	<button class="querieslink" onclick="openPage('show2', this, 'blue','queriescontent','querieslink')">find the names of drivers in Athens department</button>
	<button class="querieslink" onclick="openPage('show3', this, 'blue','queriescontent','querieslink')">find all customers that have at least one incomplete reservation</button>
	<button class="querieslink" onclick="openPage('show4', this, 'blue','queriescontent','querieslink')">find the earnings of branch in Rhodes for 2017</button>
	<button class="querieslink" onclick="openPage('show5', this, 'blue','queriescontent','querieslink')">find every vehicle's fuel type</button>
	<button class="querieslink" onclick="openPage('show6', this, 'blue','queriescontent','querieslink')">find number of employees per branch</button>
	<button class="querieslink" onclick="openPage('show7', this, 'blue','queriescontent','querieslink')">find customers with more than 2 reservations</button>
	<button class="querieslink" onclick="openPage('show8', this, 'blue','queriescontent','querieslink')">find customers that have rented vehicles more than 1400cc big</button>
	<button class="querieslink" onclick="openPage('show9', this, 'blue','queriescontent','querieslink')">find which cars have been delivered in a different branch from the one they belong to</button>
	<button class="querieslink" onclick="openPage('show10', this, 'blue','queriescontent','querieslink')">find the cities where more than 3 customers live</button>
	
	<div id="show1" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th></tr>
";

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
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$stmt = $conn->prepare("select `Last Name`,`First Name`
												from customer,vehicle,reserves
												where reserves.`Customer ID`=customer.`Customer ID` and
												reserves.`License Plate`=vehicle.`License Plate` and
												UPPER(vehicle.Type) like '%MOTORBIKE%'
										  "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
		
		
		
	 </div>
	
	<div id="show2" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select `Last Name`,`First Name`
											from employee,works,store
											where employee.`IRS Number`=works.`IRS Number` and 
											UPPER(works.Position) like'%DRIVER%' and
											store.StoreID=works.StoreID and
											UPPER(store.City) like'%ATHENS%' 
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
		
		
		
	 </div>
	 
	 	<div id="show3" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select `Last Name`,`First Name` 
											from customer,(
												select * 
												from reserves 
												where (`License Plate`,`Start Date`,`Customer ID`)
												  not in 
													(select `License Plate`,`Start Date`,`Customer ID` 	
													from rents)) as T
											where customer.`Customer ID`=T.`Customer ID`
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show4" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Sum</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select sum(`Payment Amount`)
											from `payment transaction`,rents
											where rents.`License Plate`=`payment transaction`.`License Plate` and
											rents.`Start Date`=`payment transaction`.`Start Date` and
											rents.`Finish Date` like '2017%' and
											UPPER(rents.`Start Location`) like '%RHODES%'
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show5" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Make</th><th>Model</th><th>Fuel Type</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select vehicle.Make,vehicle.Model,`fuel type`.`Fuel Type`
											from vehicle
											inner join `fuel type` on vehicle.`License Plate`=`fuel type`.`License Plate`
											order by `fuel type`.`Fuel Type`
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show6" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>City</th><th>Number of employees</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select store.City,count(works.`IRS Number`)
											from (works
											inner join store on store.StoreID=works.StoreID)
											group by store.City
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show7" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th><th>Number of reservations</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select customer.`Last Name`,customer.`First Name`,count(reserves.`Customer ID`)
											from (customer
											inner join reserves on customer.`Customer ID`=reserves.`Customer ID`)
											group by reserves.`Customer ID`
											having count(reserves.`Customer ID`)>2
											order by customer.`Last Name`
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show8" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select `Last Name`,`First Name`
											from customer 
											  inner join( 
												select `Customer ID`
												from rents
												where exists (select `License Plate` from vehicle where `License Plate`=rents.`License Plate`
												and `Cylinder Capacity`>1400)) as T
											  on T.`Customer ID`=customer.`Customer ID`
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show9" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Make</th><th>Model</th><th>License Plate</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select Make, Model,vehicle.`License Plate`
											from vehicle,rents
											where rents.`License Plate`=vehicle.`License Plate` and
											strcmp(UPPER(rents.`Start Location`),UPPER(rents.`Finish Location`))<>0
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 	 	<div id="show10" class="queriescontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>City</th><th>Number of customers</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select customer.City,count(customer.City)
											from customer
											group by customer.City
											having count(customer.City)>3
											order by customer.City
											"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	
</div>

<div id="Cars" class="tabcontent">

	<style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.carlink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 15%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.carcontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}

	#Insert {background-color: white;}
	</style>
	
	<h3>Choose your action!</h3><br>

	<button class="carlink" onclick="openPage('showcar', this, 'blue','carcontent','carlink')">Show all cars</button>
	<button class="carlink" onclick="openPage('showfuel', this, 'blue','carcontent','carlink')">Show fuel type</button>
  
	<div id="showcar" class="carcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>License Plate</th><th>Model</th><th>Type</th><th>Make</th><th>Year</th><th>Kilometers</th><th>Cylinder Capacity</th><th>Horsepower</th><th>Damage</th><th>Malfunctions</th><th>Next Service</th><th>Insurance Exp Date</th><th>Last Service</th><th>Store ID</th></tr>
";

		/*		class TableRows extends RecursiveIteratorIterator { 
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
				}*/
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//$stmt = $conn->prepare("SELECT License Plate, Model, Type,Make,	Year,	Kilometers,	'Cylinder Capacity',Horsepower,Damage,Malfunctions,	'Next Service',	'Insurance Exp Date','Last Service','Store ID' FROM vehicle"); 
					$stmt = $conn->prepare("SELECT * FROM vehicle order by Make"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
		
		
		
	 </div>
	
	<div id="showfuel" class="carcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>License Plate</th><th>Fuel Type</th></tr>";
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM `fuel type` order by `Fuel Type` "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
		
		
		
	 </div>
	
</div>

<div id="Employees" class="tabcontent">
  <style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.emplink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 15%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.empcontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}
	</style>
	
	<h3>Choose your action!</h3><br>

	<button class="emplink" onclick="openPage('showemp', this, 'blue','empcontent','emplink')">Show all employees</button>
	<button class="emplink" onclick="openPage('showworks', this, 'blue','empcontent','emplink')">Show status</button>
	<button class="emplink" onclick="openPage('updateemp', this, 'blue','empcontent','emplink')">Update</button>
	<button class="emplink" onclick="window.location.href = 'insert_admin.php'">Insert</button>
	<button class="emplink" onclick="openPage('deleteemp', this, 'blue','empcontent','emplink')">Delete</button>
<!--	<button class="emplink" onclick="openPage('deleteworks', this, 'blue','empcontent','emplink')">Delete Works</button> 

	<div id="deleteworks" class="empcontent">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<?php
	 
					/*$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select `IRS Number`, `First Name`,`Last Name` from works order by `Last Name`");
					
					echo "<select name='delete'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
								  $id = $row['IRS Number'];
								  $firstname = $row['First Name'];
								  $lastname = $row['Last Name']; 
								  echo '<option value="'.$id.'">'.$lastname.' '.$firstname.', IRS: '.$id.'</option>';
				}

					echo "</select>";
			*/?>
				<input type="submit" name="formSubmitdel" value="Submit" />
		</form>
		<?php
			/*if(isset($_POST['delete']))
			{
				$varPerson = $_POST['delete'];
				if($varPerson != 'tpt'){
					$conn->query("DELETE FROM `employee` WHERE `IRS Number`='$varPerson' ");
					echo "<script>alert('Record deleted successfully')</script>";
				}
			}*/
		?>
	
	</div>
  -->
	<div id="showworks" class="empcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>IRS Number</th><th>Store ID</th><th>Start Date</th><th>Finish Date</th><th>Position</th></tr>";

				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//$stmt = $conn->prepare("SELECT License Plate, Model, Type,Make,	Year,	Kilometers,	'Cylinder Capacity',Horsepower,Damage,Malfunctions,	'Next Service',	'Insurance Exp Date','Last Service','Store ID' FROM vehicle"); 
					$stmt = $conn->prepare("SELECT * FROM works order by Position "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
		
		
		
	</div>
	 
	<div id="showemp" class="empcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>IRS Number</th><th>SSN</th><th>License</th><th>First Name</th><th>Last Name</th><th>Street</th><th>Street Number</th><th>Postal Code</th><th>City</th></tr>";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//$stmt = $conn->prepare("SELECT License Plate, Model, Type,Make,	Year,	Kilometers,	'Cylinder Capacity',Horsepower,Damage,Malfunctions,	'Next Service',	'Insurance Exp Date','Last Service','Store ID' FROM vehicle"); 
					$stmt = $conn->prepare("SELECT * FROM employee order by `Last Name` "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
	</div>
	 
	<div id="deleteemp" class="empcontent">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<?php
	 
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select `IRS Number`, `First Name`,`Last Name` from employee order by `Last Name`");
					
					echo "<select name='delete'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
								  $id = $row['IRS Number'];
								  $firstname = $row['First Name'];
								  $lastname = $row['Last Name']; 
								  echo '<option value="'.$id.'">'.$lastname.' '.$firstname.', IRS: '.$id.'</option>';
				}

					echo "</select>";
			?>
				<input type="submit" name="formSubmitdel" value="Submit" />
		</form>
		<?php
			if(isset($_POST['delete']))
			{
				$varPerson = $_POST['delete'];
				if($varPerson != 'tpt'){
					$conn->query("DELETE FROM `employee` WHERE `IRS Number`='$varPerson' ");
					echo "<script>alert('Record deleted successfully')</script>";
				}
			}
		?>
	</div>
	 
	<div id="updateemp" class="empcontent">
		<form action="admin_update.php" method="post">
			<?php
	 
					$conn = new mysqli('localhost', 'root', '', 'mydatabase') 
					or die ('Cannot connect to db');
					
					$result = $conn->query("select `IRS Number`, `First Name`,`Last Name` from employee order by `Last Name`");
					
					echo "<select name='update'>";
					echo "<option value='tpt'>SELECT</option>";
					while ($row = $result->fetch_assoc()) {
								  $id = $row['IRS Number'];
								  $firstname = $row['First Name'];
								  $lastname = $row['Last Name']; 
								  echo '<option value="'.$id.'">'.$lastname.' '.$firstname.', IRS: '.$id.'</option>';
				}

					echo "</select>";
			?>
				<input type="submit" name="formSubmitupd" value="Select" />
		</form>
		
	</div>
	 
</div>

<div id="Clients" class="tabcontent">
  <style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.clientlink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 15%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.clientcontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}

	</style>
	
	<h3>Choose your action!</h3><br>

	<button class="clientlink" onclick="openPage('showclient', this, 'blue','clientcontent','clientlink')">Show all customers</button>
	<button class="clientlink" onclick="openPage('showres', this, 'blue','clientcontent','clientlink')">Show all reservations</button>
	<button class="clientlink" onclick="openPage('showrent', this, 'blue','clientcontent','clientlink')">Show all rentings</button>
	<button class="clientlink" onclick="openPage('showpaytrans', this, 'blue','clientcontent','clientlink')">Show all payment transactions</button>
	
	<div id="showclient" class="clientcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Customer ID</th><th>IRS Number</th><th>SSN</th><th>First Name</th><th>Last Name</th><th>License</th><th>First Registration</th><th>Street</th><th>Street Number</th><th>Postal Code</th><th>City</th></tr>
";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM customer order by `Last Name` "); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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

	 </div>
	 <div id="showres" class="clientcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>License Plate</th><th>Start Date</th><th>Start Location</th><th>Finish Location</th><th>Finish Date</th><th>Paid</th><th>Customer ID</th></tr>
";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM reserves order by `Start Date`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 <div id="showrent" class="clientcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>License Plate</th><th>Start Date</th><th>Start Location</th><th>Finish Location</th><th>Finish Date</th><th>Return State</th><th>Customer ID</th><th>IRS Number</th></tr>
";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM rents order by `License Plate`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
	 
	 <div id="showpaytrans" class="clientcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Start Date</th><th>License Plate</th><th>Payment Amount</th><th>Payment Method</th></tr>
";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM `payment transaction` order by `Payment Method`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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
		
	 </div>
</div>

<div id="Stores" class="tabcontent">
	<style>
	* {box-sizing: border-box}

	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}

	/* Style tab links */
	.storelink {
		background-color:#3EB9A5;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 7px 6px;
		font-size: 17px;
		width: 15%;
	}


	/* Style the tab content (and add height:100% for full page content) */
	.storecontent {
		color: black;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}

	</style>
	
  <h3>Choose your action!</h3><br>

	<button class="storelink" onclick="openPage('showstore', this, 'blue','storecontent','storelink')">Show all stores</button>
	<button class="storelink" onclick="openPage('mailstore', this, 'blue','storecontent','storelink')">E-mail</button>
	<button class="storelink" onclick="openPage('phonestore', this, 'blue','storecontent','storelink')">Phone Number</button>
	
	<div id="showstore" class="storecontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>StoreID</th><th>Street</th><th>Street Number</th><th>Postal Code</th><th>City</th></tr>";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM store"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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

	 </div>
	
	<div id="mailstore" class="storecontent">
	<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>StoreID</th><th>E-mail</th></tr>";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM `email address`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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

	 </div>
  
  <div id="phonestore" class="storecontent">
	<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>StoreID</th><th>Phone Number</th></tr>";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM `phone number`"); 

					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

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

	 </div>
  
  
</div>

<script>
function openPage(pageName,elmnt,color,content,link) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName(content);
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName(link);
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
//document.getElementById("defaultOpen").click();
</script>


     
</body>
</html> 
