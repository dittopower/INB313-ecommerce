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
		
		echo '<tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td>TOTAL: $'.$total.'</td></tr></table>'; ?>
		
		<br><br><center>
		<?php if(isset($_SESSION['Email'])) {?>
			<input id="payBtn" type="button" name="pay" value="Proceed to payment" onclick="ga('send', 'event', 'checkout', 'proceed', 'checkout proceed', 1);">
		<?php }else{ echo "Login to proceed with checkout"; } ?>
		</center>
	<?php
		if(count($items) == 0){ echo 'Empty Cart.'; }
		
	} else { echo 'Empty Cart.'; }
?>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
