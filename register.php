<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
<?php
	if(isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['shipping']) && isset($_POST['contact'])){
		
		$email = mysqli_real_escape_string($mysqli,$_POST['email']);
		$firstname = mysqli_real_escape_string($mysqli,$_POST['firstname']);
		$surname = mysqli_real_escape_string($mysqli,$_POST['surname']);
		$p1 = md5(mysqli_real_escape_string($mysqli,$_POST['password']));
		$p2 = md5(mysqli_real_escape_string($mysqli,$_POST['password1']));
		$ship = mysqli_real_escape_string($mysqli,$_POST['shipping']);
		$contact = mysqli_real_escape_string($mysqli,$_POST['contact']);
		
		$exist = singleSQL("SELECT Email FROM users WHERE Email='$email'", $mysqli);
		if($email == $warehousee){ $exist=$warehousee;}
		if($p1 === $p2 && $exist == null){
				
			$userid = singleSQL('SELECT UserID FROM users ORDER BY UserID DESC LIMIT 1', $mysqli) + 1;
			
			$sql1 = runSQL("INSERT INTO users (UserID, Email, Password, ShippingAddress, FirstName, Surname, ContactNum) VALUES('$userid','$email','$p1','$ship','$firstname','$surname','$contact')", $mysqli);

			if($sql1){
				echo "Welcome $firstname";
				$_SESSION['Email'] = $email;
				echo '<meta http-equiv="refresh" content="0; url=index.php" />';
			} else { echo 'Something went wrong.'; }
		}
		else{
			if($exist != null){ echo 'A user with this email already exists.'; }
			else { echo 'Passwords don\'t match.'; }
		}
		
	}
	else{
		echo 'Please fill in the appropriate fields.';
	}
	
	?>
	<h1>Register</h1>
	
	<form method="post" action="">
		<label>Email Address</label><br><input type="text" name="email"><br>
		<label>First Name</label><br><input type="text" name="firstname"><br>
		<label>Surname</label><br><input type="text" name="surname"><br>
		<label>Shipping Address</label><br><input type="text" name="shipping"><br>
		<label>Password</label><br><input type="password" name="password"><br>
		<label>Password again</label><br><input type="password" name="password1"><br>
		<label>Contact Number</label><br><input type="text" name="contact"><br>
		<input type="submit">
	</form>
	
<!-- CONTENT END -->
	
</div></div>
<?php include 'footer.php'; ?>
