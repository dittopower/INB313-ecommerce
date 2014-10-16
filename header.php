<?php session_start(); ?>
<?php include 'connection_include.php'; ?>
<?php include 'functions.php'; ?>
<?php include 'cart.php'; ?>
<HTML>
<HEAD>
	
	<TITLE>CC3D</TITLE>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="./images/cc3d.ico">
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script>
		function addToCart(id){
			$.ajax({
			  url: './cart.php?addToCart=' + id,
			  success: function(data) {
				location.reload();
			  }
			});
		}
		
		function resetCart(){
			$.ajax({
			  url: './cart.php?resetCart=1',
			  success: function(data) {
				location.reload();
			  }
			});
		}
	</script>

</HEAD>
<BODY>
	<div id="header">
		<img src="./images/CC3D.png" id="logo">CC3D - 1v1 Rust
		<div id="loginInfo">
		
		<?php
			include 'login.php';
		?>
		
		</div>
	</div>