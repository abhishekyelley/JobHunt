<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>

	
</head>
<body>
	<?php
        include("joblink.php");
        include("login.php");
		if(isset($_SESSION["id"]))
			header("Location: homie.php");
	?>
<a style="position: fixed; z-index: 50;" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>

        
		<div class="nav">
			<a  href="homie.php"><i class="fa fa-home"></i><br>Home</a>
			<a href="jobbie.php"><i class="fa fa-briefcase"></i><br>Jobs</a>
			<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<a class="bongu" href="index.php"><i class="fa fa-sign-in"></i><br>Log In</a>
			<a href="profiley.php"><i class="fa fa-user"></i><br>Profile</a>
		</div><?php 
			if( isset($_POST['submit']) ){
				$finame = $_POST['finame'];
				$laname = $_POST['laname'];
				$usname = $_POST['usname'];
				$pswd = $_POST['pswd'];
				$ustype = $_POST['ustype'];
				if(createAccount($finame,$laname,$usname,$pswd,$ustype,$con)): ?>
					<h1 style="position: absolute; top:15%;left:37%">Account Created Successfully!</h1><h2 style="position: absolute; top:18%;left:46%">Please Login</h2>
			<?php 
				else:
					header("Location: new.php?taken=1");
				endif;
				}
		?>
		
	<div class="container" id="container">
		<div class="form-container log-in-container">
			<form action="login.php" method="post">
				<h1>Login</h1>
				<?php if(isset($_GET['invalid'])) {		?>
					<a style="position:absolute;top:25%">INVALID LOGIN DETAILS<br>Try again</a>
				<?php } ?>
				<div class="social-container"></div>
				<span>If new, <a href="new.php">create account</a></span>
				<input type="email" name="uname" placeholder="Email" required/>
				<input type="password" name="password" placeholder="Password" required/>
				<br><!-- <a href="https://cdn.vox-cdn.com/thumbor/U1naWq-H27NhFJVXQBb1875iO8I=/0x0:1636x1636/920x613/filters:focal(718x840:978x1100):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/68912259/nft.0.png">Forgot your password?</a> -->
				<button type="submit" name="log-in-btn">Log In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
					<h1>Job Hunt</h1>
					<p>Login to Job Hunt to get the best job searching experience.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
