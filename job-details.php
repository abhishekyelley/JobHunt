<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="stylyl.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
	<style>
		body{
			margin-left: 25px;
			margin-right: 25px;
			width:50%;
			align-items: center;
			justify-content: center;
			margin-left:25%;
		}
		body,h1{
			font-family: 'Quicksand', sans-serif;
		}
		h1{
			background: radial-gradient(circle, rgb(223, 193, 153) 23%, rgb(224, 194, 212) 100%);
			border-radius: 10px;
			padding-left: 5px;
		}
		a{
			font-family: 'Poppins', sans-serif;
			color: black;
			text-decoration: none;
		}
	</style>

</head>
<body>


	<?php
		include("joblink.php");
		include("login.php");
		$jid = $_GET['myid'];
		$qry = "SELECT * FROM `jobs` WHERE `id` = '$jid'";
		$testy = $con->query($qry);
		$value = $testy->fetch_assoc();
		if(isset($_GET['appstat'])){
			if( $_GET['appstat'] == 1 ) {
				$uid = $_SESSION['id'];

				if( $_SESSION['utype'] == 1) {
					$insqry = "INSERT INTO `applier` (`jobid`, `userid`) VALUES ('$jid', '$uid')";
					$con->query($insqry);
				}
				else{?>
					<p style="text-align:center;color:red;font-weight:800">Boss cannot enroll for Jobs!</p>
					<?php
				}
			}
			else if($_GET['appstat'] == 2){
				$uid = $_SESSION['id'];
				$dqry = "DELETE FROM `applier` WHERE `jobid` = '$jid' AND `userid` = '$uid'";
				$con->query($dqry);
			}
		}
	?>
	<h1 style="position:sticky;top: 0;text-align: left;height: calc(30px + 20px);transition: all 0.2s ease-in;"><?php echo $value['jtitle'];?></h1>
	<p><?php echo $value['jtitle'];?> <i style="font-size: 4px;" class="fa fa-circle"></i> <?php echo $value['location'];?></p>
	<br>
	<a><i style="margin-left: 20px;"class="fa fa-briefcase"></i> <?php echo $value['jtype'];?></a>
	<p><img class="user" src="<?php echo $value['com-pic']; ?>"> <a href="https://www.anits.edu.in/home.php"><?php echo $value['company'];?> </a></p><br>
	<?php if( checkJobs(  $_SESSION['id'], $jid, $con ) ) :
	?>
		<form action="job-details.php?myid=<?php echo $value['id'];?>&appstat=2" method="post">
		<button type="submit" class="btn" style="background: gray;border:none">
			<img style="transform:translate(-15%,12.5%)" height=40 width=40 src="chettha.png">
			<span style="font-family: 'Work Sans', sans-serif;font-size: 13px;">Applied</span>
		</button>
	</form>
	<?php
	elseif($_SESSION['utype'] == 2 || $_SESSION['utype'] == 3):?>
		<form action="job-details.php?myid=<?php echo $value['id'];?>&appstat=1" method="post">
		<button type="submit" class="btn" style="background-color:gray">
			<span style="font-family: 'Work Sans', sans-serif;font-size: 13px;text-align:center">You're the BOSS</span>
		</button>
	</form>
	<?php else : ?>
	<form action="job-details.php?myid=<?php echo $value['id'];?>&appstat=1" method="post">
		<button type="submit" class="btn">
			<img style="transform:translate(-15%,12.5%)" height=40 width=40 src="chettha.png">
			<span style="font-family: 'Work Sans', sans-serif;font-size: 13px;">Apply Now</span>
		</button>
	</form>
	<?php endif ?>
	<br>
	<?php
		$pqry = "SELECT `propic` FROM `users` WHERE `id` IN (SELECT `creator` FROM `jobs` WHERE `id` = '$jid')";
		$res = $con->query($pqry);
		$res = $res->fetch_assoc();
	?>
	<p><span style="font-size:19px;font-weight:800;color:rgb(59, 59, 59)">Posted By</span><br>
	<img class="user" style="transform: translate(0%,65%);" 
		src="<?php echo $res['propic']; ?>"> <a href="#"><?php echo $value['employer_name'];?></a><br><span 
		style="padding-left:55px;font-size: 15px;"><?php echo $value['employer_title'];?></span></p><br>

	<span style="font-size:19px;font-weight:800;color:rgb(59, 59, 59)">Description</span>
	<p style='margin-left: 20px;font-size:17px;font-family: "Work Sans", sans-serif;'>
		<?php echo $value['jdesc'];?><br><br>
		Time: <?php echo $value['jtype'];?><br><br>
		Age: <?php echo $value['age'];?><br><br>
		Education: <?php echo $value['education'];?><br><br>
		Experience: <?php echo $value['experience'];?><br><br>
	</p>
	<div class="boxy">
		<br>
		<a>Pay Range:</a><br>
		<p><?php echo $value['pay'];?></p>
	</div>



	<script>
		function applying(x){
			if(x=='firsty'){
				window.open("https://forms.gle/hNKpas7qAecjwif46");
			}
		}
	</script>
</body>
</html>
