<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>

<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
	<?php if(isset($_SESSION['Email']) && $_SESSION['Email'] == $warehousee){
			if(isset($_POST['item'])){
				$itemid = $_POST['item'];
				
				$ye = runSQL("UPDATE orders SET Status='Shipped' WHERE OrderID=".$itemid);
				if($ye){ echo "Order #".$itemid." marked as shipped."; }
				else{ echo "Something went wrong."; }
			}
	?>
		
		<h2>Orders</h2>
		<form action="" method="get"><label for="orderid">Search by order ID</label><br><input type="text" id="orderid" name="orderid"><input type="submit" value="Search"></form>
		<table id="tableList">
		<th>ID</th>
		<th>Name</th>
		<th>Total Cost</th>
		<th>Items</th>
		<th>Date</th>
		<th>Status</th>
		<th>Ship It</th>
		<?php
			$sql = "SELECT OrderID, OrderCost, ItemsOrdered, DateOrdered, Status, users.FirstName AS fn, users.Surname AS sn FROM orders LEFT JOIN users ON orders.CreatedBy=users.UserID";
			
			if(isset($_GET['orderid']) && $_GET['orderid'] != ""){ $sql .= " WHERE OrderID=" . $_GET['orderid']; }
			$ayy = multiSQL($sql);
			while($rows = mysqli_fetch_array($ayy,MYSQLI_BOTH)){
				echo "<tr>";
				echo "<td>Order #" . $rows['OrderID'] . "</td>";
				echo "<td>".$rows['fn']." ".$rows['sn']."</td>";
				echo "<td>$" . sprintf('%0.2f',$rows['OrderCost']) . "</td>";
				echo "<td>";
				
				$items = explode(' ', $rows['ItemsOrdered']);
				
				for($i=0; count($items) > $i; $i++){
					$id = $items[$i];
					$itemInfo = singleRowSQL("SELECT Name, Price FROM designs WHERE DesignID=$id");
					echo "<a href='./product.php?item=" . $id . "'>" .$itemInfo['Name'] . "</a> ($" . sprintf('%0.2f',$itemInfo['Price']) . ")<br>";
				}
				
				echo "<br></td>";
				echo "<td>" . $rows['DateOrdered'] . "</td>";
				echo "<td>" . $rows['Status'] . "</td>";
				if($rows['Status'] == "Shipped"){
					echo "<td></td>";
				}else{ echo "<td><form action='' method='post'><input type='hidden' name='item' value='".$rows['OrderID']."'><input type='submit' value='Mark As Shipped'></form></td>"; }
				echo "</tr>";
			}
		
		?>
		</table>
		
<?php }else{ echo 'You aren\'t the warehouse.'; } ?>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
