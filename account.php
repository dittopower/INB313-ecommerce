<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
<?php
	//Ensure a USER is viewing the user page
	if (isset($_SESSION['Email'])){
		echo "<h1>User Account Controls</h1><hr>";
		
	// Password Change
		$match = 0;$wrong = 0;
		if (isset($_POST['word1'])||isset($_POST['word2'])||isset($_POST['word3'])){
			if ($_POST['word2'] != $_POST['word3']){
				$match = 1;
			}
			
			$dbPassword = singleSQL("SELECT Password FROM users WHERE Email='$_SESSION[Email]'", $mysqli);
			if($dbPassword === md5($_POST['word1'])){
				$wrong = 0;
			}else{
				$wrong = 1;
			}
			
			if(!$match && (!$wrong)){
					$passw = md5($_POST['word2']);
					$sql = "UPDATE users SET `password` = '$passw' WHERE Email = '$_SESSION[Email]' LIMIT 1";
					runSQL($sql);
					$done = 1;
			}
		}
	// End PW Change
?>
	<?php if ($done){echo "<h3>!!Password Changed!!</h3>";}?>
	
	
	<div id=userinfo>
		<h2>Details</h2>
		<?php 
			$sql = "SELECT * FROM users where Email = '$_SESSION[Email]'";
			$row = singleRowSQL($sql, $mysqli);
			echo "<b> Email:</b> $row[Email]<br>";
			echo "<b> Name:</b> $row[FirstName] $row[Surname]<br>";
		?>
	</div>
	
	<div id=pwbox>
		<form id='passchange' method='POST'>
			<h2>Change Password</h2>
			<input name='word1' type='password' placeholder='Old Password'>
			<?php if ($wrong){ echo "Wrong Password!";} ?><br>
			<input name='word2' type='password' placeholder='New Password'>
			<input name='word3' type='password' placeholder='Repeat New Password'><br>
			<?php if ($match){echo "New Passwords Don't Match.<br>";} ?>
			<input type='submit' value='Change'>
		</form>
	</div>
	<hr>
	
<?php
	}else{
		echo "...There's no point to this page when your not <b>Logged in</b>..";
	}
?>


<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>