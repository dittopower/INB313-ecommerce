<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
<div id="middleContainer"><div id="middle">

<!-- CONTENT START -->
	<?php

		if(isset($_GET['item'])){
			$id=mysqli_real_escape_string($mysqli,$_GET['item']);
			$row = singleRowSQL("SELECT DesignID, Description, File, Name, Price, Available, Material, Categories FROM designs WHERE DesignID=$id");
			if($row == 0){
				echo "<h2>Product not found :(<br><br>#sadboys2001</h2>";
			}else{
			
				if(isset($_SESSION['Email'])){$myemail = $_SESSION['Email'];}else{$myemail='';}
				$authoremail = singleSQL("SELECT Email FROM users WHERE UserID=(SELECT Author FROM designs WHERE DesignID=$id)");
				
				$materialName = singleSQL("SELECT Name FROM materials WHERE MaterialID=" . $row['Material']);
				
				if(isset($_GET['edit']) && isset($_SESSION['Email'])){
					
					if(isset($_POST['title']) && isset($_POST['price']) && isset($_POST['matr']) && isset($_POST['desc']) && isset($_POST['catcat']) ){
						$t = mysqli_real_escape_string($mysqli,$_POST['title']);
						$p = mysqli_real_escape_string($mysqli,$_POST['price']);
						$m = mysqli_real_escape_string($mysqli,$_POST['matr']);
						$d = mysqli_real_escape_string($mysqli,$_POST['desc']);
						$c = mysqli_real_escape_string($mysqli,$_POST['catcat']);
						$shedooooo = runSQL("UPDATE designs SET Name='$t', Price=$p, Material=$m, Description='$d', Categories='$c' WHERE DesignID=$id");
						if($shedooooo){ echo 'Product updated.'; }
						else{ echo 'Failed to update.'; }
						$row = singleRowSQL("SELECT DesignID, Description, File, Name, Price, Available, Material, Categories FROM designs WHERE DesignID=$id");
					}
					
						$materials = multiSQL('SELECT MaterialID, Name, CostPerCubicCM FROM materials');
						
						if($myemail == $authoremail){
							echo '
							<script>document.title = "CC3D - '.$row["Name"].'";</script>
							<a href="./ModelFiles/'. $row['File'] .'" target="_blank"><img src="./ModelFiles/'. $row['File'] .'" id="itemImg"></a>
							<h2><form method="post" action="./product.php?item='.$id.'&edit=1"><input name="title" type="text" value="' . $row["Name"] . '"></input> - $<input name="price" type="number" step="0.01" value="' . sprintf('%0.2f',$row["Price"]) . '"></input></h2>
							<p>
								Material: <select name="matr">';
								
								while($rows = mysqli_fetch_array($materials,MYSQLI_BOTH)){
									echo '<option value="' . $rows['MaterialID'] . '"';
									if($rows['MaterialID'] == $row['Material']){ echo ' selected="selected"'; }
									echo '>' . $rows['Name'] . ' - $' . sprintf('%0.2f',$rows['CostPerCubicCM']) . '</option>';
								}
								
								echo '</select><br><br><textarea name="desc" id="desc">' . $row["Description"] .'</textarea><br><br>
								Tags: <input name="catcat" type="text" value="' . $row["Categories"] . '"></input><br><br><input type="submit" value="Save"></input></form>
							</p>
							<div class="clear"></div>';
							
						}
					
				}else{
					echo '
					<script>document.title = "CC3D - '.$row["Name"].'";</script>
					<a href="./ModelFiles/'. $row['File'] .'" target="_blank"><img src="./ModelFiles/'. $row['File'] .'" id="itemImg"></a>
					<h2>' . $row["Name"] . ' - $' . sprintf('%0.2f',$row["Price"]) . '</h2>
					<p>
						Material: ' . $materialName . '<br><br>
						'. $row["Description"] .'<br><br>
						Tags: ' . $row["Categories"] . '
					</p>
					<input type="button" value="Add To Cart" onclick="addToCart(' . $id . ');">';
					if($myemail == $authoremail){ echo '<input type="button" value="Edit Product" onclick="window.location=\'./product.php?item='.$id.'&edit=1\'">'; }
					echo '<div class="clear"></div>';
					
					$tags = explode(',', $row["Categories"]);
					
					$relatedSQL="SELECT DesignID, File, Name, Price FROM designs WHERE Categories LIKE ";
					
					$relatedSQL .= "'%" . $tags[0] . "%'";
					
					for($i = 1; count($tags) > $i; $i++){
						$relatedSQL .= " OR Categories LIKE '%".$tags[$i]."%'";
					}
					
					$relatedSQL .= " ORDER BY RAND() LIMIT 4";
					
					$rel = multiSQL($relatedSQL);
					
					echo '<br><br><div id="related"><h2>Related Items</h2>';
					
					while($rows = mysqli_fetch_array($rel,MYSQLI_BOTH)){
						echo '<a href="./product.php?item=' . $rows["DesignID"] . '&'. $rows["Name"].'"><div class="third">';
						echo '<div class="text">' . $rows["Name"] . ' - $' . sprintf('%0.2f',$rows["Price"]) . '</div>';
						echo '<img src="./ModelFiles/'. $rows["File"] .'"></div></a>';
					}

					echo '</div><div class="clear"></div>';
				}
			}
		}else{
	
			if(isset($_SESSION['Email']) && isset($_POST['name']) && isset($_POST['material']) && isset($_POST['price']) && isset($_POST['categories'])){
				
				$email = $_SESSION['Email'];
				$userid = singleSQL("SELECT UserID FROM users WHERE Email='$email'");	
				$designID = singleSQL('SELECT DesignID FROM designs ORDER BY DesignID DESC LIMIT 1') + 1;				
				
				$originalFile = $_FILES["model"]["name"];
				$tmp = explode('.', $originalFile);
				$extension = end($tmp);
				
				$fileName = $designID . "." . $extension;
				move_uploaded_file($_FILES["model"]["tmp_name"], "./ModelFiles/" . $fileName);
				
				$name = mysqli_real_escape_string($mysqli,$_POST['name']);
				$material = mysqli_real_escape_string($mysqli,$_POST['material']);
				$price = mysqli_real_escape_string($mysqli,$_POST['price']);
				$category = mysqli_real_escape_string($mysqli,$_POST['categories']);
				$description = mysqli_real_escape_string($mysqli,$_POST['descrip']);

				$sql1 = runSQL("INSERT INTO designs (designID, Description, File, Categories, Name, Price, Available, Author, Material) VALUES($designID,'$description', '$fileName','$category','$name',$price,'Yes',$userid,'$material')");

				if($sql1){
					echo 'Design submitted.';
					echo "<script>ga('send', 'event', 'design', 'submit', 'Design Submitted $userid', 1);</script>";
				} else { echo 'Something went wrong.'; }
					
			}
			
		if((!isset($_GET['item'])) && isset($_SESSION['Email'])  ){ ?>

			<h1>My Products</h1>
			<table id="tableList">
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Material</th>
					<th></th>
				</tr>
				<?php
					$email = $_SESSION['Email'];
					$userid = singleSQL("SELECT UserID FROM users WHERE Email='$email'");
					
					$ayy = multiSQL("SELECT DesignID, Name, Price, Available, Material FROM designs WHERE Author=$userid");
					while($rows = mysqli_fetch_array($ayy,MYSQLI_BOTH)){
						echo "<tr>";
						echo "<td><a href='./product.php?item=" . $rows['DesignID'] . "'>" . $rows['Name'] . "</a></td>";
						echo "<td>$" . sprintf('%0.2f',$rows['Price']) . "</td>";
						$materialll = singleSQL("SELECT Name FROM materials WHERE MaterialID=" . $rows['Material']);
						echo "<td>" . $materialll . "</td>";
						echo '<td align="right"><input type="button" value="Edit Product" onclick="window.location=\'./product.php?item='.$rows['DesignID'].'&edit=1\'"></td>';
						echo "</tr>";
					}
				?>
			</table>
			<div id="newPro">
				<h1>Submit New Product</h1>
				
				<form method="post" action="" enctype="multipart/form-data">
					<label>Name of product</label><br><input type="text" name="name" placeholder='Naruto Mug'><br>
					<label>Product description</label><br><textarea name="descrip"></textarea><br>
					<label>Material to be made out of</label><br>
					<select name="material">
					<?php
						$materials = multiSQL('SELECT MaterialID, Name, CostPerCubicCM FROM materials');
						while($rows = mysqli_fetch_array($materials,MYSQLI_BOTH)){
							echo '<option value="' . $rows['MaterialID'] . '">' . $rows['Name'] . ' - $' . sprintf('%0.2f',$rows['CostPerCubicCM']) . '</option>';
						}
					?>	
					</select><br>
					<label>Price to sell at</label><br><input type="number" step="0.01" name="price" placeholder='$'><br>
					<label>Categories/Tags</label><br><input type="text" name="categories" placeholder='E.g. mug, naruto, coffee'><br>
					<label>Image File</label><br><input type="file" name="model"><br>
					<label>Model File (disabled)</label><br><input type="file" disabled><br><br>
					<input type="submit" value="Submit Design">
				</form>
			</div>
			
	<?php
		} else { echo $notLoggedInMessage; }
	} 
	?>

<!-- CONTENT END -->

</div></div>
<?php include 'footer.php'; ?>
