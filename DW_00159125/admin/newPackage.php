<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../templates/header.php'; 

					if(isset($_SESSION['msg'])){
						echo '<script type="text/javascript">alert("' . $_SESSION['msg']. '")</script>';
						unset($_SESSION['msg']);
					}
					
					
	include_once '../dbCon.php';
	$conn= connect();

    if(isset($_POST['add_package']) || isset($_POST['update_package'])){
		
			$okFlag = TRUE;
			$message = '';
		
		if(!isset($_REQUEST['name']) || $_REQUEST['name'] == ''){
			$message .= 'Please type your name.\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['price']) || $_REQUEST['price'] == ''){
			$message .= 'Please type Price.\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['location']) || $_REQUEST['location'] == ''){
			$message .= 'Please type location.\n';
			$okFlag = FALSE;
		}
		
		
		//image upload start
		if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != ''){
			//print_r($_FILES["fileToUpload"]["name"]);exit;
			$target_dir = "../img/upload/";
			$newName = date('YmdHis_');
			$newName .= basename($_FILES["fileToUpload"]["name"]);
			$target_file = $target_dir . $newName;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			
			// Allow certain file formats
			if($imageFileType != "JPG" &&$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				$okFlag = FALSE;
			// if everything is ok, try to upload file
			} else {
				
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". $newName. " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
					$okFlag = FALSE;
				}
			}
			//echo $newName;exit;
		}else{
			$newName = $_POST['image'];
			//echo $newName;exit;
		}
		
		
		//image upload end
		if($okFlag){
			$name = $_POST['name'];
			$price = $_POST['price'];
			$location= $_POST['location'];
			
			 
					
			//$image= $_FILES["fileToUpload"]["name"];
			
			if(isset($_POST['add_package'])){			
				$sql= "INSERT INTO `packages` (`name`, `price`, `location`, `image`) VALUES ('$name', $price, '$location', '$newName');";				
				$msg1='Package sucessfully created.\n';
			}
			else if(isset($_POST['update_package'])){
				$id = $_POST['id'];
				$sql = "UPDATE `packages` SET `name`='$name',`price`=$price, `location`='$location',`image`='$newName' WHERE id=$id";			
				$msg1='Package sucessfully Updated.\n';
			}
			if($conn->query($sql)===TRUE){
				$message=$msg1;
				$_SESSION['msg'] = $message;
				header('location:newPackage.php');
			}
			
						
		}
		$_SESSION['msg'] = $message;
		header('location:newPackage.php');
	}
	$sql= "SELECT * from packages";
			$result=$conn->query($sql);
			$editFlag = FALSE;	
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$editFlag = TRUE;
		$sql= "SELECT * from packages WHERE id=$id";
		$resultData=$conn->query($sql);
		foreach($resultData as $items){
			$id = $items['id'];
			$name = $items['name'];
			$price = $items['price'];
			$location = $items['location'];			
			$image = $items['image'];
		}
	}
?>


				

  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="#" class="tm-site-name">Woodlands Away</a>	
  				</div>
	  			<div class="col-lg-6 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0){ ?>
								<li><a href="admin/newPackage.php" class="active">Create Packages</a></li>
								<li><a href="showbooking.php">Show Bookings</a></li>
								<li><a href="../forum.php">Forum</a></li>
							<?php } ?>																		
							<?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){ ?>								
								<li><a href="../logout.php"><?=$_SESSION['username']?>-Logout</a></li>
							<?php }else{ ?>
								<li><a href="LogIn.php">Log-In</a></li>
							<?php } ?>
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	

	
	
	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			
		</div>
	
		<div class="section-margin-top">
			<div class="row">				
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Create Packages</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>
			</div>
		</div>
		
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<div class="col-lg-13 col-md-4 col-sm-6">
				
												
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-createpackage">
					<ul class="nav nav-tabs tm-white-bg" role="tablist" id="hotelCarTabs">
					  
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active tm-white-bg" id="hotel">
					    	<div class="tm-form-inner">
							<form id="add_package" action="" method="POST" role="form" enctype="multipart/form-data" >
								<input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
								<input type="hidden" name="image" value="<?php if(isset($image)) echo $image; ?>">
								<div class="form-group">
									<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="<?php if(isset($name)) echo $name; ?>">
								</div>										
								<div class="form-group">
									<input type="text" name="price" id="price" tabindex="2" class="form-control" placeholder="Price" value="<?php if(isset($price)) echo $price; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="location" id="location" tabindex="3" class="form-control" placeholder="Location" value="<?php if(isset($location)) echo $location; ?>">
								</div>
								<div class="form-group">
									<input type="file" name="fileToUpload"  class="form-control" >
								</div>
								
								
								<div class="row">
									<div class="form-group tm-yellow-gradient-bg text-center">
										<button type="submit" name="update_package" value="update_package" id="update_package" tabindex="4" class="tm-yellow-btn" <?php echo (!$editFlag)? 'disabled': '' ;?>>Update Package</button>
										<button type="submit" name="add_package" value="add_package" id="add_package" tabindex="5" class="tm-yellow-btn" <?php echo ($editFlag)? 'disabled': '' ;?>>Create Package</button>	
									</div>									
								</div>
						</div>	
					    </div>					   				    
					</div>			
				</div>

				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6">
				
			</div>			
			
				<div class="row">
						<table class="table table-striped">
							<tr>
								<th>Package Name</th>
								<th>Images</th>
								<th>Price</th>
								<th>Location</th>								
								<th>Action</th>
							</tr>
							<?php foreach($result as $row){ ?>
							<tr>
								<td><?=$row['name']?></td>
								<td><img src="<?=BASE_URL?>/img/upload/<?=$row['image']?>" width="100"></td>
								<td><?=$row['price']?></td>
								<td><?=$row['location']?></td>								
								<td><a href="<?=BASE_URL?>/admin/newPackage.php?id=<?=$row['id']?>" class="btn btn-xs btn-warning">Edit</a></td>
							</tr>
							<?php  } ?>					
						</table>
				</div>		
			
		</div>
	</section>	
	
	
	
		<!-- Footer -->
	
	<?php include '../templates/Footer.php';