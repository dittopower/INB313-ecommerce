<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>

<div id="nav2">
	<div id="smaller">
		<div id="search"><form class="inline" method="get" action="./"><input id="searchText" type="search" name="search" placeholder="Search by Tags or Names" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>"><input type="submit" value="Search"></div>
		<div id="filter" >

			  <div id="test">Price range:</div>
			  <input type="text" name="price" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
			 
			<div id="slider-range"></div>
			
		</div>
		
		</form>
		<div class="clear"></div><br>
	</div>
</div>

<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->

<?php 

	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($mysqli,$_GET['search']);
		if($_GET['search']=="" && round($setmin)==round($mmin) && round($setmax)==round($mmax)){
			echo '<h2>Catalogue</h2>';	
		}else{ echo '<h2>Search result for: "' . $search . '"<br>Price range: $'.$setmin.' - $'.$setmax.'</h2>'; }
		$ayy = multiSQL("SELECT DesignID, File, Name, Price, Available FROM designs WHERE Price > $setmin AND Price < $setmax AND (Name LIKE '%" . $search . "%' OR Categories LIKE '%" . $search . "%')");
	}else{ 
	
		$ban = singlerowSQL("SELECT File, DesignID, Name, Price FROM designs ORDER BY RAND() LIMIT 1"); ?>
				
		<div id="banner">
			<img id="main" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="left" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="right" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<div id="text"><a href="./product.php?item=<?php echo $ban['DesignID'] . "\">" . $ban['Name'] . " - $" . sprintf('%0.2f',$ban['Price']); ?></a></div>
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
