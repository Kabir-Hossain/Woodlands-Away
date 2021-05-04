


<?php include 'templates/header.php';

	include_once "dbCon.php";
	$conn = connect();

		if(isset($_SESSION['msg'])){
			echo '<script type="text/javascript">alert("' . $_SESSION['msg']. '")</script>';
			unset($_SESSION['msg']);
		}
		
	$okFlag = TRUE;
	$message = '';
	
	if(!isset($_REQUEST['question']) || $_REQUEST['question'] == ''){
		$message .= 'Please type your question.\n';
		$okFlag = FALSE;
	}

	if($okFlag){
		$question	= $_REQUEST['question'];
		$cname		= $_SESSION['username'];
		$answer		= $_REQUEST['answer'];
		$ansq		= $_REQUEST['question'];
		$ansqid		= $_REQUEST['questionid'];
		
/* 		echo $answer;
				echo $ansq;
				echo $cname;
				exit(); */
		

		if(isset($_POST['submit'])){			
				$sql = "INSERT INTO `forum_questions`(`question`, `customer_name`) VALUES ('$question','$cname')"; 
				$result = $conn->query($sql);
				$msg1 ='Your question is submited sucessfully.\n';
			
			$message=$msg1;
			$_SESSION['msg'] = $message;
			header('location:forum.php');
			}		
	
		if(isset($_POST['anssubmit'])){
				echo
				$sql = "INSERT INTO `forum_ans`(`answer`, `customer_name`, `q_id`) VALUES ('$answer','$cname','$ansqid')"; 
				$result = $conn->query($sql);
				$msg1 ='Your answer is submited sucessfully.\n';
			
			$message=$msg1;
			$_SESSION['msg'] = $message;
			header('location:forum.php');
			}		
	}
	
		$sql= "SELECT * from forum_questions";
			$result=$conn->query($sql);
		
		
			

	if(isset($_GET['id'])){
		$id = $_GET['id'];
				
		$sql= "SELECT `q_id`, `question` from forum_questions WHERE q_id=$id";
		$resultData=$conn->query($sql);
		if($resultData == True){
			
			
		foreach($resultData as $fq){
			$qid = $fq['q_id'];
			$question = $fq['question'];
			
			}
		}
	}
		if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql= "SELECT * from forum_ans where `q_id`=$id";
			$resultans=$conn->query($sql);

		}

?>


<body>
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
								<li><a href="admin/newPackage.php">Create Packages</a></li>
								<li><a href="admin/showbooking.php">Show Bookings</a></li>
								<li><a href="forum.php" class = "active">Forum</a></li>
							<?php } ?>
							<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1){ ?>
								<li><a href="index.php">Home</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="packages.php">Packages</a></li>
								<li><a href="forum.php" class = "active">Forum</a></li>
							<?php } ?>													
							<?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){ ?>								
								<li><a href="logout.php"><?=$_SESSION['username']?>-Logout</a></li>
							<?php }else{ ?>
								<li><a href="LogIn.php">Log-In</a></li>
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
		
	</section>		
	
	<!-- white bg -->
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">Forum Questions</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
				<!-- contact form -->
				<form action="" method="post" class="tm-contact-form">
					<input type="hidden" name="id" value="<?php if(isset($qid)) echo $qid; ?>">
					<div class="col-lg-6 col-md-6 tm-contact-form-input">
						<div class="form-group">
							<textarea type="text" name="question" id="question" class="form-control" rows="2" placeholder="ASK QUESTIONS"></textarea>
						</div>						
						<div class="form-group">
							<button class="tm-yellow-btn" type="submit" value="submit"  name="submit">Ask Questions</button> 
						</div>
						<div class="form-group">
							<h4> <a href = ""> All QUESTIONS </a>  </h4>
						</div>
						<div class="row">
								<table class="table table-striped">
									<tr>
										<th>Questions</th>																		
									</tr>
									<?php foreach($result as $row){ ?>
									<tr>
										<td><a href="<?=BASE_URL?>/forum.php?id=<?=$row['q_id']?>"><?=$row['question']?></a></td>
									</tr>
									<?php  } ?>					
								</table>
						</div>
					</div>
				</form>
							
				
								<?php if(isset($resultData)===true) {?>
									<form action="" method="post" class="tm-contact-form">
										<div class="col-lg-6 col-md-6 tm-contact-form-input">						
											<div class="form-group">
												<input type="" name="question" class="form-control" value="<?php if(isset($question)) echo $question; ?>">
											</div>											
											<div class="form-group">												
												<table class="table table-striped">
													<tr>
														<th>Answer</th>									
													</tr>
													<?php foreach($resultans as $row){ ?>
													<tr>
														<td><?=$row['answer']?></td>
													</tr>
													<?php  } ?>					
												</table>												
											</div>
											<div class="form-group">
												<textarea type="text" name="answer" id="answer" class="form-control" rows="2" placeholder="Comments"></textarea>
												<input type="hidden" name="questionid" class="form-control" value="<?php echo $qid ?>">
											</div>
											<div class="form-group">
												<button class="tm-yellow-btn" type="submit" value="anssubmit" name="anssubmit">Answer</button> 
											</div>               
										</div>
									</form>
								<?php }?>
									
									
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 tm-contact-form-input">
					<div class="form-group">
						
					</div>					
				</div>
			</div>
		</div>
	</section>
	<!-- Footer -->
	
	<?php include 'templates/Footer.php'; ?>
	
	<script>
	
		/* Google map
      	------------------------------------------------*/
      	var map = '';
      	var center;

      	

	    

	    	
      	// DOM is ready AIzaSyDvHk8s7yiLWqa_IUqqRqZ1z0BICfa_FGU
		$(function() {

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

		  	// Flexslider
		  	$('.flexslider').flexslider({
		  		controlNav: false,
		  		directionNav: false
		  	});		  	
		  });
	</script>
</body>
</html>
