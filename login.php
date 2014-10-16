<!-- CONTENT START -->
<?php
	$fail = false;
	if(isset($_POST['emailL']) && isset($_POST['passwordL'])){
		
		$email = strtolower($_POST['emailL']);
		$pass = $_POST['passwordL'];

		$p = mysqli_query($mysqli,"SELECT Password FROM users WHERE Email='" . $email ."'");
		
		if($p -> num_rows !== 0){
	
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$dbPassword = $t[0];

			if($dbPassword === md5($pass)){
				$_SESSION['Email'] = $email;
			} else {
				$fail = true;
			}

		} else {
			$fail = true;
		}//if returns empty
		
	}else if (isset($_POST['logout'])){
		$_SESSION = array();
		session_destroy();
	}
	
	
	if (isset($_SESSION['Email'])){ ?>
		<a href='<?php echo "./account.php";?>'>Logged in as: <?php echo $_SESSION['Email']; ?></a>
		<form id='userForm' method='POST'>
			<input name='logout' hidden><input id='logoutbtn' type='submit' value='Logout'>
	<?php }else{ 
		echo "<a href='./register.php'>Register</a>";
		echo "<form id='userForm' method='POST' ";
		if ($fail){ echo "style='background:red;'";}
			echo "><input type='email' name='emailL' placeholder='Email'>";
			echo "<input type='password' name='passwordL' placeholder='Password'>";
			echo "<input type='submit' value='>'>";
	} ?>
	</form>

