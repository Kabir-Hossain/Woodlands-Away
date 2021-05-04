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

    if(isset($_POST['update_package'])){
		
			$okFlag = TRUE;
			$message = '';
		
		if(!isset($_REQUEST['name']) || $_REQUEST['name'] == ''){
			$message .= 'Please type your name.\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['ctype']) || $_REQUEST['ctype'] == ''){
			$message .= 'Please Cabin type .\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['Sdate']) || $_REQUEST['Sdate'] == ''){
			$message .= 'Please Select Start date .\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['Edate']) || $_REQUEST['Edate'] == ''){
			$message .= 'Please Select End date .\n';
			$okFlag = FALSE;
		}
		if(!isset($_REQUEST['price']) || $_REQUEST['price'] == ''){
			$message .= 'Please type Price.\n';
			$okFlag = FALSE;
		}
		if($okFlag){
			
			$name = $_POST['name'];
			$ctype = $_POST['ctype'];
			$Sdate= $_POST['Sdate'];
			$Edate= $_POST['Edate'];
			$adult= $_POST['adult'];
			$children= $_POST['children'];
			$price= $_POST['price'];
			
			
			//$image= $_FILES["fileToUpload"]["name"];
			
			if(isset($_POST['update_package'])){
				$id = $_POST['id'];
				$sql = "UPDATE `booking` SET `package_name`='$name',`cabin_type`='$ctype',`start_date`='$Sdate',`end_date`='$Edate',`adult`='$adult',`children`='$children',`price`='$price' WHERE booking_Id=$id";
							
				$msg1='Package sucessfully Updated.\n';
			}
			if($conn->query($sql)===TRUE){
				$message=$msg1;
				$_SESSION['msg'] = $message;
				header('location:showbooking.php');
			}
						
		}
		$_SESSION['msg'] = $message;
		header('location:showbooking.php');
	}
	$sql= "SELECT * from booking";
			$result=$conn->query($sql);
			$editFlag = FALSE;	
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$editFlag = TRUE;
		$sql= "SELECT * from booking WHERE booking_Id=$id";
		$resultData=$conn->query($sql);
		foreach($resultData as $items){
			$id = $items['booking_Id'];
			$name = $items['package_name'];
			$ctype = $items['cabin_type'];
			$Sdate = $items['start_date'];
			$Edate = $items['end_date'];
			$adult = $items['adult'];
			$children = $items['children'];
			$price = $items['price'];

			/* echo $name;
			exit(); */
			
			
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
								<li><a href="newPackage.php">Create Packages</a></li>
								<li><a href="showbooking.php" class="active">Show Bookings</a></li>
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
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Show Bookings</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>
			</div>
		</div>
		
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<div class="col-lg-13 col-md-4 col-sm-6">
				
												
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-showbooking">
					<ul class="nav nav-tabs tm-white-bg" role="tablist" id="hotelCarTabs">
					  
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active tm-white-bg" id="hotel">
					    	<div class="tm-form-inner">
							<form id="add_package" action="" method="POST" role="form" enctype="multipart/form-data" >
								<input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
								
								<div class="form-group">
									<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="<?php if(isset($name)) echo $name; ?>">
								</div>	
								<div class="form-group">
									<input type="text" name="ctype" id="ctype" tabindex="" class="form-control" placeholder="Cabin type" value="<?php if(isset($ctype)) echo $ctype; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="Sdate" id="Sdate" tabindex="2" class="form-control" placeholder="Start date" value="<?php if(isset($Sdate)) echo $Sdate; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="Edate" id="Edate" tabindex="3" class="form-control" placeholder="End date" value="<?php if(isset($Edate)) echo $Edate; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="adult" id="adult" tabindex="3" class="form-control" placeholder="Adult" value="<?php if(isset($adult)) echo $adult; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="children" id="children" tabindex="3" class="form-control" placeholder="Children" value="<?php if(isset($children)) echo $children; ?>">
								</div>
								<div class="form-group">
									<input type="text" name="price" id="price" tabindex="3" class="form-control" placeholder="Price" value="<?php if(isset($price)) echo $price; ?>">
								</div>
								
								
								<div class="row">
									<div class="form-group tm-yellow-gradient-bg text-center">
										<button type="submit" name="update_package" value="update_package" id="update_package" tabindex="4" class="tm-yellow-btn">Update Package</button>										
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
								<th>Cabin Type</th>								
								<th>Start Date</th>
								<th>End Date</th>
								<th>Adults</th>
								<th>Childrens</th>
								<th>price</th>
								<th>Edit Booking</th>
							</tr>
							<?php foreach($result as $row){ ?>
							<tr>
								<td><?=$row['package_name']?></td>
								<td><?=$row['cabin_type']?></td>
								<td><?=$row['start_date']?></td>
								<td><?=$row['end_date']?></td>								
								<td><?=$row['adult']?></td>
								<td><?=$row['children']?></td>							
								<td><?=$row['price']?></td>
								<td><a href="<?=BASE_URL?>/admin/showbooking.php?id=<?=$row['booking_Id']?>" class="btn btn-xs btn-warning">Edit</a></td>
							</tr>
							<?php  } ?>					
						</table>
				</div>		
			
		</div>
	</section>	
	
	
	
		<!-- Footer -->
	
	<?php include '../templates/Footer.php';