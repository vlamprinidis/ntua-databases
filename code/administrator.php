<!DOCTYPE html>
<html>
    <body>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			Enter password for administrator use:<br><br>
			Password: <input type="password" name="password">
			<br><br>
			<input type="submit" name="submit" value="OK">  
		</form>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if( strcmp($_POST["password"],"admin") == 0 ){ // if correct
					$redir = "admin_correct.php";
					header("Location: $redir");
				}
				else{
					echo "<p>Wrong password</p>";
				}
			}
		?>
	</body>
</html>
