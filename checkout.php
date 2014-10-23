<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->

<?php
	$total = 0;
	if(isset($_COOKIE[$cookie_name])) {
		
		$cookie_value = $_COOKIE[$cookie_name];
		$items = explode(",", $cookie_value);
		$numitems = count($items);
		//gets the cart items
		
		if(isset($_POST['suborder'])){
			
			for($i = 0; $i < count($items); $i++){
				$id=$items[$i];
				$ee = singleRowSQL("SELECT Name, Price FROM designs WHERE DesignID=$id");
				$total += $ee[1];
			}
			$email = $_SESSION['Email'];
			$userid = singleSQL("SELECT UserID FROM users WHERE Email='$email'");
			$orderid = singleSQL('SELECT OrderID FROM orders ORDER BY OrderID DESC LIMIT 1') + 1;
			
			$cartspaces = str_replace(',', ' ', $cookie_value);
			
			$sql = "INSERT INTO orders (OrderID, CreatedBy, OrderCost, ItemsOrdered, DateOrdered,Status) VALUES($orderid,$userid,$total,'$cartspaces','".date('Y-m-d H:i:s')."','Payment Pending')";
			
			$ye = runSQL($sql);
						
			if($ye){
				echo '<center><h1>Order  successfully placed :)</h1>Order number: #' . $orderid . '<br><br>Total Cost: $'.sprintf('%0.2f',$total+$shipping).' ($'.sprintf('%0.2f',$total).' + $'.$shipping.' Shipping)';
				
				echo '<br><br>Current status: <strong>Awaiting payment</strong><br><br><h2>Please proceed to payment: </h2>';
				
				echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="roflmonster.jh@gmail.com">
				<input type="hidden" name="item_name" value="CC3D - Order '. $orderid .'">
				<input type="hidden" name="currency_code" value="AUD">
				<input type="hidden" name="amount" value="' . ($total + $shipping) . '">
				<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
				</form></center>';
				
				 echo "<script>silresetCart(); ga('send', 'event', 'checkout', 'pay', 'paymentmade', $total);</script>";

			}else{ echo 'Order failed.'; }

		}else{
			$total += $shipping;//shipping offset
			
			echo "<script>ga('send', 'event', 'checkout', 'view', 'checkout viewed', $numitems);</script>";
			?>
			<table id="checkout"><tr>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price</th></tr>
			<?php
			for($i = 0; $i < count($items); $i++){
				echo '<tr>';
				$id=$items[$i];
				$ee = singleRowSQL("SELECT Name, Price FROM designs WHERE DesignID=$id");
				echo '<td><a href="./product.php?item='.$items[$i].'">' . $ee[0] . '</td>';
				echo '<td>1</td>';
				echo '<td>$' . sprintf('%0.2f',$ee[1]) . '</td>';
				$total += $ee[1];
				echo '</tr>';
			}
			echo '<tr><td></td><td></td><td></td></tr>';
			echo '<tr><td><strong>Shipping</strong></td><td></td><td>$'.sprintf('%0.2f',$shipping).'</td></tr>';
			
			echo '<tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td>TOTAL: $'.sprintf('%0.2f',$total).'</td></tr></table>'; ?>
			
			<br><br><center>
			<?php if(isset($_SESSION['Email'])) {?>
				<form action="" method="post"><input type="hidden" name="suborder" value="yes"><input id="payBtn" type="submit" name="pay" value="Place Order" onclick="ga('send', 'event', 'checkout', 'proceed', 'submit order', 1);"></form>
			<?php }else{ echo "Login to proceed with checkout"; } ?>
			</center>
			
		<?php
			if(count($items) == 0){ echo 'Empty Cart.'; }
		
		}//onto the payment screen
		
	} else { echo 'Empty Cart.'; }
?>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
