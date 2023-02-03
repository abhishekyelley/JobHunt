<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
</head>
<body>
	
	<a style="position: fixed; z-index: 50;" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>

        
	<div class="nav">
			<a  href="homie.php"><i class="fa fa-home"></i><br>Home</a>
			<a href="jobbie.php"><i class="fa fa-briefcase"></i><br>Jobs</a>
			<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<a class="bongu" href="index.php"><i class="fa fa-sign-in"></i><br>Log In</a>
			<a href="profiley.php"><i class="fa fa-user"></i><br>Profile</a>
		</div>
	<div class="container" id="container">
		
		<div class="form-container log-in-container">
			<form>
				
				<?php
					if(!isset($_GET['taken'])):
				?>
					<h1>Register</h1>
				<?php
					else:?>
					<h2 style="color:red">Email Already Registered!</h2>
					<a style="position:absolute;top:80%;" href="index.php">Already have an account? Click here to Login</a>
				<?php endif; ?>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
					<div class="logg-in-container ">
							<h1 style="text-align:center;transform:translate(0%,-30%)">Create new account</h1>
							<form action="index.php" method="post">
								<input type="text" placeholder="First Name" name="finame" id="name" style="width:43%;left:3%;top:30%" required/>
								<input type="text" placeholder="Last Name" name="laname" id="name" style="width:43%;left:53%;top: 30%" required/>
								<input type="email" placeholder="Email" name="usname" style="width:93%;left:3%;top: 42%" required/>
								
								

								<input type="password" name="pswd" placeholder="Password" style="width:93%;left:3%;top: 54%" required/>
								<div class="wrapper">
									<input onclick="displaypopup();" type="radio" name="ustype" id="option-1" value="1" checked>
									<input onclick="closepopup();" type="radio" name="ustype" id="option-2" value="2">
									<label for="option-1" class="option option-1">
										<div class="dot"></div>
										<span>Hunter</span>
										</label>
									<label for="option-2" class="option option-2">
										<div class="dot"></div>
										<span>Deployer</span>
									</label>
								</div>
								<br><br><br><br><br><br><br><br><br><br>
								<!-- <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" > -->
								<button type="submit" name="submit" >Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div id="intrst" class="con2 pullout" style="z-index:-1;margin-top:-44.32em;margin-left:83em;width:25%;"></div>	 -->

	<script>
		function displaypopup()
		{
			var popup = document.querySelector('.con2');
			popup.style.display = 'block';
			document.getElementById('intrst').className = 'con2 pullout';
		}
		function closepopup()
		{
			var popup = document.querySelector('.con2');
			document.getElementById('intrst').className = 'con2 pullin';
			// popup.style.display = 'none';
		}
	</script>

</body>
</html>
