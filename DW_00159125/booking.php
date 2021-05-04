
 
<?php	include 'templates/header.php';
		
	
					if(isset($_SESSION['msg'])){
						echo '<script type="text/javascript">alert("' . $_SESSION['msg']. '")</script>';
						unset($_SESSION['msg']);
					}

 
	if(isset($_POST['ok'])){		
		
	$okFlag = TRUE;
	$message = '';
	if(!isset($_REQUEST['cabin_type']) || $_REQUEST['cabin_type'] == ''){
		$message .= 'Please Select cabin type.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['start_date']) || $_REQUEST['start_date'] == ''){
		$message .= 'Please Select Start Date.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['end_date']) || $_REQUEST['end_date'] == ''){
		$message .= 'Please Select End Date.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['adults']) || $_REQUEST['adults'] == ''){
		$message .= 'Please Select Number of Adults.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['childrens']) || $_REQUEST['childrens'] == ''){
		$message .= 'Please Select Number of Childrens.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['price']) || $_REQUEST['price'] == ''){
		$message .= 'Price is not declared.\n';
		$okFlag = FALSE;
	}
	if($okFlag){
		$packagename	= $_REQUEST['packagename'];
		$cabintype		= $_REQUEST['cabin_type'];
		$start_date 	= $_REQUEST['start_date'];
		$end_date 		= $_REQUEST['end_date'];
		$adults 		= $_REQUEST['adults'];
		$childrens 		= $_REQUEST['childrens'];
		$price	 		= $_REQUEST['price'];
		$name	 		= $_SESSION['username'];
		
		
	
		
	include_once "dbCon.php";
		$conn = connect(); 
		$sql = "SELECT * FROM booking WHERE (package_name='$packagename') AND (cabin_type='$cabintype') AND (start_date='$start_date') AND (end_date='$end_date')"; 
		$result = $conn->query($sql); 
		
		
		
		if($result->num_rows <= 0){
			$sql = "INSERT INTO booking(package_name, book_by,cabin_type,start_date,end_date,adult,children,price) VALUES ('$packagename','$name','$cabintype','$start_date','$end_date','$adults','$childrens','$price')";
			
			if($conn->query($sql)===true){
				
				
				include_once "mailsender.php";
				
					$name	 		= $_SESSION['username'];
					$to				= $_SESSION['email'];
					$subject		= 'Information about boooking of Woodlands Log Cabin Packages';
					$content		= 'Your Log Cabin is booked. Enjoy your Holidays';
				
				sendMail($to,$name,$subject,$content);
				
				
				
				
				$_SESSION['msg'] = ' Your Booking is Confirmed & Email has been sent';
				header('location:packages.php?');
			}else{
				$_SESSION['msg'] = 'Database Error';
				header('location:packages.php');
			}
		}else{
			$_SESSION['msg'] = 'Booking is not available, Please Select another Date or Another Package.\n';
			header('location:packages.php');
		}
	}else{
		$_SESSION['msg'] = $message;
		header('location:booking.php?msg='.$message);
	}
	
	
		
	}	 
?>
	<script>
		var fromCurrency = 'GBP';
	</script>
	
	<script>
		document.onreadystatechange = function(){
			if(document.readyState === 'complete'){
				var dateToday = new Date(); 
				
				$( function() {
					$( "#start_date" ).datepicker({
						beforeShowDay: DisableMonday,
						minDate: dateToday,
						onClose: function(selectedDate) {
							$("#end_date").datepicker("option", "minDate", selectedDate);
						}
					});
				  });
				  
				  $(function() {
					 $( "#end_date" ).datepicker({
						beforeShowDay: DisableMonday,
						minDate: dateToday,
						onClose: function(selectedDate) {
							$("#start_date").datepicker("option", "maxDate", selectedDate);
						}
					 });
				 });
				 
				function DisableMonday(date) {
					var day = date.getDay();
					 if (day == 2 || day == 3 || day == 4 || day == 6 || day == 0) {
						return [false] ; 
					 } else { 
						return [true] ;
					 }
				}
				  
				 
				  
				  
			}
		}
	</script>
		

	<section class="container tm-home-section-1" id="more">
		<div class="row">
			
		</div>
	
		<div class="section-margin-top">
			<div class="row">				
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Package Booking</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>
			</div>		
			
			<?php 
				include_once 'dbCon.php';
				$conn= connect();
				$sql= "SELECT * from packages WHERE id=($_POST[pid])";
				$resultData=$conn->query($sql);					
				
				foreach($resultData as $book){
					
					
					
					
					
			?>
			
			<div class="row">			
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="tm-search-box effect2">
						<form action="" method="post" class="hotel-search-form">
							<div class="tm-form-inner">
								<div class="form-group">
									<input type="text" name="packagename" tabindex="1" class="form-control" value="<?=$book['name']?>">
								</div>
								<div class="form-group">
									<input type="text" name="book_by" class="form-control" value="<?php if(isset($_SESSION['username'])) echo ($_SESSION['username']); ?>">
								</div>
								<div class="form-group">								
									 <select type="text" name="cabin_type" tabindex="2" class="form-control">
										<option value="">-- Select Cabin Type -- </option>
										<option value="Luxury Cabin">Luxury Cabin</option>
										<option value="Contemporary Cabin">Contemporary Cabin</option>
										<option value="Orignal Cabin">Orignal Cabin</option>						
									</select> 
								</div>
								<div class="form-group">
									<div class="form-group">
										<input type="text" name="start_date" id="start_date" tabindex="3" class="form-control" placeholder="Start Date" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="form-group">
										<input type="text" name="end_date" id="end_date" tabindex="4" class="form-control" placeholder="End Date" value="">
									</div>
								</div>
								<div class="form-group">
									<input type="text" name="adults" tabindex="5" class="form-control" placeholder="Number of Adults" value="">
								</div>
								<div class="form-group">
									<input type="text" name="childrens"  tabindex="6" class="form-control" placeholder="Number of childrens" value="">
								</div>
								<div class="form-group">
									<input type="text" name="price" id="price" tabindex="7" class="form-control" placeholder="Price" value="<?=$book['price']?>">
									<input type="hidden" class="package-base-price" value="<?=$book['price']?>" />
								</div>
							</div>							
							<div class="form-group tm-yellow-gradient-bg text-center">
								<button type="submit" name="ok" class="tm-yellow-btn">Confim Booking</button>
							</div>
							
						</form>						
					</div>					
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="tm-tours-box-1">
						<img src="<?=BASE_URL?>/img/upload/<?=$book['image']?>" alt="image" class="img-responsive">
						<div class="tm-tours-box-1-info">
							<div class="tm-tours-box-1-info-left">
								<p class="text-uppercase margin-bottom-20">The Luxury Log Cabin with other Facilities</p>	
								<p class="text-uppercase margin-bottom-20">
								<select id="currency">
									<option value='GBP'>GBP</option>
									<option value='USD'>USD</option>
									<option value='EUR'>EUR</option>
								</select>
									<h4 class="pull-right package-price"><?=$book['price']?></h4>
									<input type="hidden" class="package-base-price" value="<?=$book['price']?>" />
								</p>								
							</div>
							<div class="tm-tours-box-1-info-right">
								<p class="gray-text tours-1-description">The beauty of a Woodlands Log Home begins with nature’s finest quality log, and hybrid style home products.</p>	
							</div>							
						</div>						
					</div>						
				</div>				
			</div>
			<?php } ?>
		</div>
	</section>
	
	<!-- Footer -->
	
	<?php include 'templates/Footer.php'; ?>
	