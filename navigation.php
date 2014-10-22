<div id="navbar">
	<img src="./images/CC3D-alt.png" id="logo"><strong>CC3D - 1v1 Rust</strong>

	<ul>
		<a href="./"><li>Home</li></a>
		<a href="./about.php"><li>About CC3D</li></a>
		<?php if(isset($_SESSION['Email'])){?>
		<a href="./product.php"><li>My Products</li></a>		
		<a href="./account.php"><li>My Account</li></a>
		<?php } ?>
	</ul>
		
		
	<div id="nav2">
		<form id="search" class="inline" method="get" action="./index.php"><input type="search" name="search" placeholder="Search by Tags or Names"><input type="submit" value="Search"></form>
	
		
	
		<div id="loginInfo">
	
			<?php
				include 'login.php';
			?>
		
		</div>
		<div class="clear"></div>
	</div>
	
</div>