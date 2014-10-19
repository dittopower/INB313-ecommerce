<div id="navbar">

	<ul>
		<a href="./"><li>Home</li></a>
		<a href="./about.php"><li>About CC3D</li></a>
		<?php if(isset($_SESSION['Email'])){?>
		<a href="./product.php"><li>My Products</li></a>		
		<a href="./account.php"><li>My Account</li></a>
		<?php } ?>
		<form method="get" action="./index.php"><input type="search" name="search" placeholder="Search by Tags or Names"><input type="submit" value="Search"></form>
	</ul>

</div>