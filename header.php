<?php session_start(); ?>
<?php include 'connection_include.php'; ?>
<?php include 'functions.php'; ?>
<?php
	//the any page login script
	$fail = false;
	if(isset($_POST['emailL']) && isset($_POST['passwordL'])){
		
		$email = strtolower($_POST['emailL']);
		$pass = $_POST['passwordL'];

		$p = mysqli_query($mysqli,"SELECT Password FROM users WHERE Email='" . $email ."'");
		
		if($p -> num_rows !== 0){
	
			$t = mysqli_fetch_array($p,MYSQLI_BOTH);
			$dbPassword = $t[0];

			if($dbPassword === md5($pass)){
				$_SESSION['Email'] = $email;
			} else {
				$fail = true;
			}

		} else {
			$fail = true;
		}//if returns empty
		
	}else if (isset($_POST['logout'])){
		$_SESSION = array();
		session_destroy();
	}
	
?>
<HTML>
<HEAD>
	
	<TITLE>CC3D</TITLE>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="./images/cc3d.ico">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<?php
		$mmin = singleSQL("SELECT MIN(Price) FROM designs");
		$mmax = singleSQL("SELECT MAX(Price) FROM designs");	
		
		if(($mmin-10) >=0){
			$mmin -= 10;
		} else { $mmin = 0; }
		
		$mmax += 10;
		
		$setmin = $mmin;
		$setmax = $mmax;
		
		if(isset($_GET['price'])){
			if($_GET['price'] != ""){
				$str = $_GET['price'];
				$str = str_replace("$","",$str);
				$str = str_replace(" ","",$str);
				
				$nums = explode('-', $str);

				$setmin = $nums[0];
				$setmax = $nums[1];
			}
		}
	
	?>
	<script>
		$(function() {
			$( "#slider-range" ).slider({
				range: true,
				min: <?php echo $mmin; ?>,
				max: <?php echo $mmax; ?>,
				values: [ <?php echo $setmin; ?>, <?php echo $setmax; ?> ],
				slide: function( event, ui ) {
					$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
				}
			});
			$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		});
		
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
			var height = $('#cart').height() - 8;
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
