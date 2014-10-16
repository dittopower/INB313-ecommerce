<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
<table id="checkout"><tr>
<th>Item Name</th>
<th>Quantity</th>
<th>Price</th></tr>
<?php
	$total = 0;
	if(isset($_COOKIE[$cookie_name])) {
		$cookie_value = $_COOKIE[$cookie_name];
		$items = explode(",", $cookie_value);
		
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
		
		echo '<tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td>TOTAL: $'.$total.'</td></tr>';
		
		if(count($items) == 0){ echo 'Empty Cart.'; }
	} else { echo 'Empty Cart.'; }
?>
</table>
<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
