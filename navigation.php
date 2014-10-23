<div id="navbar">
	<img src="./images/CC3D-alt.png" id="logo"><strong><a href="./">CC3D - 1v1 Rust</a></strong>

	<ul>
		<a href="./about.php"><li>About CC3D</li></a>
		<?php if(isset($_SESSION['Email'])){?>
		<a href="./product.php"><li>My Products</li></a>		
		<a href="./account.php"><li>My Account</li></a>
		<?php } ?>
	</ul>
</div>