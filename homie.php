<html>
<head>
	<link rel="stylesheet" href="stylyl.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link
    	rel="stylesheet"
    	href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  	/>
	<title>Job Hunt</title>
	<style>
		.container{
			overflow-y: hidden; 

		}
	</style>
</head>
<!-- <section class="wack">   -->
<body>
	<?php
		include("login.php");
		if (isset($_GET['logout'])) {
			session_destroy();
			unset($_SESSION['user']);
			header("location: homie.php");
		}
		if (isset( $_POST['subbed'] )){

			if (isset( $_POST['imgurl'] )) {
				$pic = $_POST['imgurl'];
				$idd = $_SESSION['id'];
				$uqry = "UPDATE `users` SET `propic`='$pic' WHERE `id` = '$idd'";
				if($_POST['imgurl'] != "")
					if($con->query($uqry))
						$_SESSION['propic'] = $pic;
			}
			if (isset( $_POST['educ'] )) {
				$educ = $_POST['educ'];
				$idd = $_SESSION['id'];
				$exists = $con->query("SELECT * FROM `extradetails` WHERE `userid` = '$idd'");
				if(mysqli_num_rows($exists) === 0){
					$con->query("INSERT INTO `extradetails` (`education`, `userid`) VALUES ('$educ', '$idd')");
				}
				else{
					$uqry = "UPDATE `extradetails` SET `education`='$educ' WHERE `userid` = '$idd'";
					$con->query($uqry);
				}
			}

		}
		

	?>
<a style="position: fixed; z-index: 50;" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>
	<!-- <div class="container"> -->
      
		<div class="nav">
			<a class="bongu" href="homie.php"><i class="fa fa-home"></i><br>Home</a>
			<a href="jobbie.php"><i class="fa fa-briefcase"></i><br>Jobs</a>
			<?php if(!isset($_SESSION['user_name'])): ?>
				<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<?php 
				elseif($_SESSION['utype'] == 2 || $_SESSION['utype'] == 3):?>
				<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<?php endif;?>
			<?php if(isset($_SESSION['user_name'])): ?>
				<a href="homie.php?logout='1'"><i class="fa fa-sign-out"></i><br>LogOut</a>
			<?php else:?>
				<a href="index.php"><i class="fa fa-sign-in"></i><br>Log In</a>
			<?php endif ?>
			<?php if(isset($_SESSION['user_name'])): ?>
				<a href="profiley.php">Hi,<br><?php echo $_SESSION['fname'] ?></a>
			<?php else:?>
				<a href="profiley.php"><i class="fa fa-user"></i><br>Profile</a>
			<?php endif ?>
				
			
		</div>

	<!-- </div> -->
	<img style="object-fit:cover;width:100%;height:auto;opacity:2%;position:fixed" src="pattern.png">
	<br><br>
	<img class="homeimg" src="boundi.png">
		<div class="bg-text">
				<h1 style="font-size:80px">Job Hunt</h1><br>
				<p>The <span>perrfectt</span> platform solely <br>built for <c>YOU</c>, the user to<br><b>Hire </b> and <b>Seek </b><k style="opacity:0;text-shadow:none;cursor:default">JOBS..</k>
					<a style="left:92%;animation-delay: 2s;">J<a style="left:93%;animation-delay: 2.2s;">O</a></a><a style="left:95.5%;animation-delay: 2.4s;">B</a><a style="left:97.5%;animation-delay: 2.6s;">S</a></a>.</p>
		</div>


	<!-- <img style="object-fit:cover;width:100%;height:50%;opacity:100%;position:relative" src="wave.png"> -->
	
  		
	
	</body>

	<!-- <div class="wave"></div> -->
	<footer>
		<div class="footer-content">
			<h3>Job Hunt</h3>
			<p>Job Hunt is a project heavily inspired from the design of many job searching platforms such as LinkedIn.</p>
			<ul class="socials">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
			</ul>
			<div class="footer-bottom">
				<p>copyright &copy;2021 <a href="homie.php">jobhunt</a>  </p>
			</div>
		</div>
		
	</footer>
	
	<!-- </section> -->

</html>
