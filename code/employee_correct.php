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

<button class="tablink" onclick="openPage('Welcome', this, 'purple','tabcontent','tablink')"  id="defaultOpen">FANCY CARS</button><br><br><br>
<button class="homebutton" onClick="window.location = 'code.php'" >Logout</button>
<button class="tablink" onclick="openPage('Cars', this, 'red','tabcontent','tablink')">Cars</button>
<button class="tablink" onclick="openPage('Employees', this, 'green','tabcontent','tablink')">Employees</button>
<button class="tablink" onclick="openPage('Clients', this, 'blue','tabcontent','tablink')">Clients</button>
<button class="tablink" onclick="openPage('Stores', this, 'orange','tabcontent','tablink')">Stores</button>
<input type="button" value="Logout" class="homebutton" onClick="window.location = 'code.php'" />

<div id="Welcome" class="tabcontent">
	<h3>Welcome to our site!</h3>
	<img src="car.jpg" alt="Car" width="500" height="377" >
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
				echo "<tr><th>Driver's License Plate</th><th>Model</th><th>Type</th><th>Make</th><th>Year</th><th>Kilometers</th><th>Cylinder Capacity</th><th>Horsepower</th><th>Damage</th><th>Malfunctions</th><th>Next Service</th><th>Insurance Exp Date</th><th>Last Service</th><th>Store ID</th></tr>
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

	<button class="emplink" onclick="openPage('showworks', this, 'blue','empcontent','emplink')">Show employees</button>
	<button class="emplink" onclick="openPage('updateemp', this, 'blue','empcontent','emplink')">Update</button>
	<button class="emplink" onclick="window.location.href = 'emp_insert.php'">Insert</button>
	<button class="emplink" onclick="openPage('deleteemp', this, 'blue','empcontent','emplink')">Delete</button>


  
	<div id="showworks" class="empcontent">
		<?php				
                echo "<table style='border: solid 1px black;'>";
				echo "<tr><th>Last Name</th><th>First Name</th><th>Position</th><th>Store ID</th></tr>";

				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mydatabase";

				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//$stmt = $conn->prepare("SELECT License Plate, Model, Type,Make,	Year,	Kilometers,	'Cylinder Capacity',Horsepower,Damage,Malfunctions,	'Next Service',	'Insurance Exp Date','Last Service','Store ID' FROM vehicle"); 
					$stmt = $conn->prepare("select employee.`Last Name`,employee.`First Name`,works.Position,works.StoreID
											from employee
											inner join works on employee.`IRS Number`=works.`IRS Number`
											order by works.StoreID "); 

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
					$stmt = $conn->prepare("SELECT * FROM works order by StoreID "); 

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
		<form action="emp_update.php" method="post">
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
