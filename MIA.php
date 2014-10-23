<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>

<div id="nav2">
	<div id="search"><form class="inline" method="get" action="./"><input type="search" name="search" placeholder="Search by Tags or Names"><input type="submit" value="Search"></div>
	<div id="filter" >

		  <div id="test">Price range:</div>
		  <input type="text" name="price" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
		 
		<div id="slider-range"></div>
		
	</div>
	
	</form>
	<div class="clear"></div><br>
	
</div>

<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->

<?php 
	echo "<h2>Sorry But the page your looking for doesn't Exist</h2><h1>=(</h1>";
	$ban = singlerowSQL("SELECT File, DesignID, Name, Price FROM designs ORDER BY RAND() LIMIT 1");
	?>
	
		<div id="banner">
			<img id="main" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="left" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<img class="blur" id="right" src="./ModelFiles/<?php echo $ban['File']; ?>">
			<div id="text"><a href="./product.php?item=<?php echo $ban['DesignID'] . "\">" . $ban['Name'] . " - $" . sprintf('%0.2f',$ban['Price']); ?></a></div>
		</div>

	<?php
	}
	
	?>
	
<div class="clear"></div>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
