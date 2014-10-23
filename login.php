<?php
if (isset($_SESSION['Email'])){ ?>
	Logged in as: <a href='<?php echo "./account.php";?>'><?php echo $_SESSION['Email']; ?></a>
	<form class="inline" id='userForm' method='POST'>
		<input name='logout' hidden><input id='logoutbtn' type='submit' value='Logout'>
<?php }else{ 
	echo "<a href='./register.php'><u>Register</u></a> or Login: ";
	echo "<form class='inline' id='userForm' method='POST' ";
	if ($fail){ echo "style='background:red;'";}
		echo "><input type='email' name='emailL' placeholder='Email'>";
		echo "<input type='password' name='passwordL' placeholder='Password'>";
		echo "<input type='submit' value='>'>";
} ?>
</form>