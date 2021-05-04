<!DOCTYPE html>

<html lang="en">
<head>

 <?php include 'templates/header.php'; ?>

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
								<li><a href="admin/newPackages.php">Create Packages</a></li>
								<li><a href="admin/showbooking.php">Show Bookings</a></li>
								<li><a href="forum.php">Forum</a></li>
							<?php } ?>
							<?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){ ?>
								<li><a href="index.php">Home</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="packages.php">Packages</a></li>
								<li><a href="forum.php">Forum</a></li>
								<li><a href="logout.php"><?=$_SESSION['username']?>-Logout</a></li>
							<?php }else{ ?>
								<li><a href="LogIn.php" class="active">Log-In</a></li>
							<?php } ?>
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	<!-- Banner -->
	
	<?php include 'templates/banner.php'; ?>

	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<div class="col-lg-13 col-md-4 col-sm-6">
				<?php 
					
					if(isset($_SESSION['msg'])){
						echo '<script type="text/javascript">alert("' . $_SESSION['msg']. '")</script>';
						unset($_SESSION['msg']);
					}
					if(isset($_SESSION['input_email'])){ 
						$email = $_SESSION['input_email']; 
						unset($_SESSION['input_email']);
					}else{
						$email = '';
					}
				/* 	if(isset($_SESSION['login_counter']))
						echo $_SESSION['login_counter']; */
				?>
												
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="tm-registration">
					<ul class="nav nav-tabs tm-white-bg" role="tablist" id="hotelCarTabs">
					    <li role="presentation" class="active">
					    	<a href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab">Sign In</a>
					    </li>
					    <li role="presentation">
					    	<a href="#car" aria-controls="car" role="tab" data-toggle="tab">Sign Up</a>
					    </li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active tm-white-bg" id="hotel">
					    	<div class="tm-search-box effect2">
								<form action="Logincheck.php" method="post" class="hotel-search-form">
									<div class="tm-form-inner">
										<div class="form-group">
											<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
										</div>
										<div class="form-group text-center">
											<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
											<label for="remember"> Remember Me</label>
										</div>
									</div>							
						            <div class="form-group tm-yellow-gradient-bg text-center">
						            	<button type="submit" name="submit" class="tm-yellow-btn">Sign In</button>
						            </div>  
								</form>
							</div>
					    </div>
					    <div role="tabpanel" class="tab-pane fade tm-white-bg" id="car">
							<div class="tm-search-box effect2">
								<form action="register.php" method="post" class="hotel-search-form" >
									<div class="tm-form-inner">
										<div class="form-group">
											<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" value="">
										</div>										
							          	<div class="form-group">
											<input type="text" name="email" id="email" tabindex="2" class="form-control" placeholder="Email Address" value="">
										</div>
										<div class="form-group">
											<input type="text" name="mobilenumber" id="mobilenumber" tabindex="3" class="form-control" placeholder="Mobile Number" value="">
										</div>
										
										<div class="form-group">
											<input type="text" name="dateofbirth" id="dateofbirth" tabindex="5" class="form-control" placeholder="Date Of Birth">
										</div>
										<div class="form-group">
							            	 <select class="form-control" id="gender" name="gender">
							            	 	<option value="">Gender </option>
							            	 	<option value="Male">Male</option>
												<option value="Female">Female</option>												
											</select> 
							          	</div>
										<div class="form-group">
											<input type="address" name="address" id="address" tabindex="5" class="form-control" placeholder="Address">
										</div>
										<div class="form-group">
											<input type="postcode" name="postcode" id="postcode" tabindex="6" class="form-control" placeholder="Post Code">
										</div>
										<div class="form-group">
											<input type="password" name="password" id="password" tabindex="7" class="form-control" placeholder="Password">
										</div>
										<div class="form-group">
											<input type="password" name="confirm-password" id="confirm-password" tabindex="8" class="form-control" placeholder="Confirm Password">
										</div>
										</div>							
										<div class="form-group tm-yellow-gradient-bg text-center">
											<button type="submit" name="submit" tabindex="9" class="tm-yellow-btn">Registration</button>
										</div>  
								</form>								
							</div>
					    </div>				    
					</div>			
				</div>				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6">
						
			</div>
		</div>
	</section>			


	<!-- Footer -->
	
	<?php include 'templates/Footer.php'; ?>
	<script>
		// HTML document is loaded. DOM is ready.
		$(function() {

			$('#hotelCarTabs a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})

        	$('.date').datetimepicker({
            	format: 'MM/DD/YYYY'
            });
            $('.date-time').datetimepicker();

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
		  	$('a[href*=#]:not([href=#])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html,body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
		  	});
		});
		
		// Load Flexslider when everything is loaded.
		$(window).load(function() {	  		
			
		    $('.flexslider').flexslider({
			    controlNav: false
		    });


	  	});
	</script>
 </body>
 </html>