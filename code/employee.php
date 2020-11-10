<!DOCTYPE html>
<html>
    <body>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Enter password for employee use:<br><br>
			Password: <input type="password" name="password">
			<br><br>
			<input type="submit" name="submit" value="OK">  
		</form>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if( strcmp($_POST["password"],"emp") == 0 ){ // if correct
					$redir = "employee_correct.php";
					header("Location: $redir");
				}
				else{
					echo "<p>Wrong password</p>";
				}
			}
		?>
	</body>
</html>
