<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
	
<?php
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		echo '<h2>Search result for: ' . $search . '</h2>';
		$ayy = multiSQL("SELECT DesignID, File, Name, Price, Available FROM designs WHERE Name LIKE '%" . $search . "%' OR Categories LIKE '%" . $search . "%'");
	}else{
		echo '<h1>New Products</h1>';
		$ayy = multiSQL("SELECT DesignID, File, Name, Price, Available FROM designs ORDER BY DesignID DESC LIMIT 10");
	}
	
	while($rows = mysqli_fetch_array($ayy,MYSQLI_BOTH)){
		echo '<a href="./product.php?item=' . $rows["DesignID"] . '&'. $rows["Name"].'"><div class="gridItem">';
		echo '<div class="text">' . $rows["Name"] . ' - $' . sprintf('%0.2f',$rows["Price"]) . '</div>';
		echo '<img src="./ModelFiles/'. $rows["File"] .'"></div></a>';
	}
?>
	
	<div class="clear"></div>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
