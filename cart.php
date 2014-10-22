<?php
	$cookie_name = "shoppingCart";
	if(isset($_GET['addToCart'])){		
		$newID = $_GET['addToCart'];//id of the product adding to cart
		$cookie_value = "";
		
		if(isset($_COOKIE[$cookie_name])) {
			$cookie_value = $_COOKIE[$cookie_name];
			$cookie_value .= "," . $newID;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30)); //86400 = 1 day
		} else {
			$cookie_value .= $newID;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30)); //86400 = 1 day
		}
	}
	else if(isset($_GET['resetCart'])){
		setcookie($cookie_name, "", time() - 3600);
	}
	
?>

<div id="cart">
	<div id="toggle" onclick='toggle();'>&#8595; Shopping Cart &#8595;</div>
	<!--<h2>Shopping Cart</h2><!--<img src="./images/cart.png" id="cartIcon">-->
	<ul>
	<?php
		if(isset($_COOKIE[$cookie_name])) {
			$cookie_value = $_COOKIE[$cookie_name];
			$items = explode(",", $cookie_value);
			
			for($i = 0; $i < count($items); $i++){
				$id=$items[$i];
				$ee = singleRowSQL("SELECT Name, Price FROM designs WHERE DesignID=$id");
				echo '<li>"<a href="./product.php?item='.$items[$i].'">' . $ee[0] . '</a>"<sub>$' . sprintf('%0.2f',$ee[1]) . '</sub></li>';
			}
			
			if(count($items) == 0){ echo 'Empty Cart.'; }
		} else { echo 'Empty Cart.'; }
	?>
	</ul>
	<form method="get" action="./checkout.php"><input type="button" value="Reset Cart" onclick="resetCart();"><input type="submit" value="Checkout"></form>
	
</div>