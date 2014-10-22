<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
	
<?php 

	$ban = singlerowSQL("SELECT File, DesignID, Name, Price FROM designs ORDER BY RAND() LIMIT 1");

	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($mysqli,$_GET['search']);
		echo '<h2>Search result for: ' . $search . '</h2>';
		$ayy = multiSQL("SELECT DesignID, File, Name, Price, Available FROM designs WHERE Name LIKE '%" . $search . "%' OR Categories LIKE '%" . $search . "%'");
	}else{ ?>
	
		<div id="banner">
			<img id="main" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="left" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="right" src="./ModelFiles/<?php echo $ban['File']; ?>">
			
			<center><h2><a href="./product.php?item=<?php echo $ban['DesignID'] . "\">" . $ban['Name'] . " - $" . sprintf('%0.2f',$ban['Price']); ?></a></h2></center>
		</div>

	<?php
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
