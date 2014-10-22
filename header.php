<?php session_start(); ?>
<?php include 'connection_include.php'; ?>
<?php include 'functions.php'; ?>
<HTML>
<HEAD>
	
	<TITLE>CC3D</TITLE>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="./images/cc3d.ico">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script>
			
		function addToCart(id){
			ga('send', 'event', 'cart', 'add', 'Item Carted '+id, 1);
			$.ajax({
			  url: './cart.php?addToCart=' + id,
			  success: function(data) {
				location.reload();
			  }
			});
		}
		
		function resetCart(){
			ga('send', 'event', 'cart', 'clear', 'cart cleared', 1);
			$.ajax({
			  url: './cart.php?resetCart=1',
			  success: function(data) {
				location.reload();
			  }
			});
		}
		
		var cartToggle = false;

		function toggle(){
			var height = $('#cart').height() - 5;
			if(cartToggle){
				$('#toggle').html("&#8595; Shopping Cart &#8595;");
				$('#cart').animate({bottom:('+=' + height)},'slow');
				cartToggle = false;
			}
			else{
				$('#toggle').html("&#8593; Shopping Cart &#8593;");
				$('#cart').animate({bottom:('-=' + height)},'slow');
				cartToggle = true;
			}
		}
	</script>

</HEAD>
<BODY>
	<?php
		include_once("analytics.php");
		include 'cart.php';
	?>
