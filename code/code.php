<!DOCTYPE html>
<html>
    <body>
		<p>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
				Login as:
				<select name="formPerson">
				  <option value="">SELECT</option>
				  <option value="C">Client</option>
				  <option value="E">Employee</option>
				  <option value="A">Administrator</option>
				</select>
				<input type="submit" name="formSubmit" value="Submit" />
			</form>

		</p>
		<?php
			if(isset($_POST['formPerson']))
			{
				$varPerson = $_POST['formPerson'];
				switch($varPerson)
				{
					case "C": $redir = "client.php"; break;
					case "E": $redir = "employee.php"; break;
					case "A": $redir = "administrator.php"; break;
					default: echo("<p>You forgot to select!</p>"); exit(); break;					
				}
				echo " redirecting to: $redir ";
			
				header("Location: $redir");
			}
		?>
    </body>
</html>

