<div id="navbar">
	<img src="./images/CC3D-alt.png" id="logo"><strong><a href="./">CC3D - 3D Printing</a></strong>

	<ul>
	<?php if(isset($_SESSION['Email']) && $_SESSION['Email']==$warehousee){ echo '<a href="./warehouse.php"><li>Warehouse</li></a>'; } else {?>
		<a href="./?search=&price="><li>Catalogue</li></a>
		<a href="./about.php"><li>About CC3D</li></a>
		
		<?php if(isset($_SESSION['Email'])){?>
		
			<a href="./product.php"><li>My Products</li></a>		
			<a href="./account.php"><li>My Account</li></a>
			
		<?php } } ?>
	</ul>
</div>