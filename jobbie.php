<html>
<head>
<link rel="stylesheet" href="stylyl.css?v=<?php echo time(); ?>">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
</head>
<body >
    <?php
        include("joblink.php");
        include("login.php");
        if(!isset($_SESSION['user_name'])){
            header("Location: index.php");
        }

        if(isset($_POST['remov'])){
          $uid = $_SESSION['id'];
          $jid = $_POST['remov'];
				  $dqry = "DELETE FROM `applier` WHERE `jobid` = '$jid' AND `userid` = '$uid'";
				  $con->query($dqry);
        }
        if(isset($_POST['appl'])){
          $uid = $_SESSION['id'];
          $jid = $_POST['appl'];
			  	// if( $_SESSION['utype'] == 1) {
					$insqry = "INSERT INTO `applier` (`jobid`, `userid`) VALUES ('$jid', '$uid')";
					$con->query($insqry);
				  // }
        }
    ?>


	<div class="job-top">
	<a style="position: fixed;top:1%;left:0.5%" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>

        
        <div class="nav">
                <a href="homie.php"><i class="fa fa-home"></i><br>Home</a>
                <a class="bongu" href="jobbie.php"><i class="fa fa-briefcase"></i><br>Jobs</a>
                <?php if(!isset($_SESSION['user_name'])): ?>
				<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<?php 
				elseif($_SESSION['utype'] == 2 || $_SESSION['utype'] == 3):?>
				<a href="peopley.php"><i class="fa fa-child"></i><br>People</a>
			<?php endif;?>                <?php if(isset($_SESSION['user_name'])): ?>
                    <a href="homie.php?logout='1'"><i class="fa fa-sign-out"></i><br>LogOut</a>
                <?php endif; ?>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <a href="profiley.php">Hi,<br><?php echo $_SESSION['fname'] ?></a>
                <?php endif; ?>
		    </div>
        <br><br><br><br><br>
        <?php
            if(isset($_GET['submit'])){
                $tqry = $_GET['tsearch'];
                $lqry = $_GET['lsearch'];
                $cqry = $_GET['csearch'];
                if(isset($_GET['sort'])){
                    $sorty = $_GET['sort'];
                    $ord = "";
                    if($sorty==1)
                        $ord = "DESC";
                    $result = $con->query("SELECT j.* FROM `jobs` AS j JOIN `applier` AS a ON a.jobid = j.id WHERE j.jtitle LIKE '%$tqry%' and j.location LIKE '%$lqry%' and j.company LIKE '%$cqry%' GROUP BY a.jobid ORDER BY COUNT(a.jobid) $ord");
                }
                else{
                    $result = $con->query("SELECT * FROM `jobs` WHERE `jtitle` LIKE '%$tqry%' and `location` LIKE '%$lqry%' and `company` LIKE '%$cqry%'");
                }
            }
        ?>

        <a style="position:absolute;left:1%">Showing results for: <?php echo mysqli_num_rows($result) ?> Jobs</a><br>
        <a><?php if(isset($_GET['sort'])){
                    $sorty = $_GET['sort'];
                    if($sorty==1)
                        echo "<a style='position:absolute;left:1%'>Sorting: High to Low</a>";
                    else
                        echo "<a style='position:absolute;left:1%'>Sorting: Low to High</a>";}?></a>
        <div class="searcher">
            <form method="GET">
            <div class="select" tabindex="1">
                <input class="selectopt" name="sort" type="radio" id="opt1" disabled checked>
                <label for="opt1" class="option">Sort By</label>
                <input class="selectopt" name="sort" type="radio" id="opt2" value=1>
                <label for="opt2" class="option">Most Applied</label>
                <input class="selectopt" name="sort" type="radio" id="opt3" value=2>
                <label for="opt3" class="option">Least Applied</label>
                <!-- <input class="selectopt" name="test" type="radio" id="opt4">
                <label for="opt4" class="option">Bananas</label>
                <input class="selectopt" name="test" type="radio" id="opt5">
                <label for="opt5" class="option">Watermelon</label> -->
            </div>


                <input name="tsearch" placeholder="Search by title..." type="text" />
                <input name="lsearch" placeholder="Search by location..." type="text" />
                <input name="csearch" placeholder="Search by company..." type="text" />
                <?php if ( $_SESSION['utype'] == 2 || $_SESSION['utype'] == 3 ) {?>
                    <a href="addjob.php" target="_blank" class="quickfix">AddJob</a>
                <?php }?>
                <input type="submit" name="submit" value="Search" />
            </form>
        </div>
</div>
        <br>

<div>
<ul class="cards">
  <?php foreach($result as $value){
        $crtr = $value['creator'];
        $ress = $con->query("SELECT propic FROM users WHERE id = '$crtr'");
        $dp = $ress->fetch_assoc()['propic'];
      ?>
  <li class="card">
    <!-- <a href="" class="card"> -->
    <!-- <div class="card_comp">
        <img src="<?php echo $value['com-pic'];?>" class="card__image" alt="" />
      </div>  -->
      <img src="<?php echo $value['com-pic'];?>" class="card__image" alt="" />
      <div class="card__overlay">
        <div class="card__header">
          <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
          <img class="card__thumb" src="<?php echo $dp;?>" alt="" />
          <div class="card__header-text">
            <h3 class="card__title"><a style="text-decoration:none;color:black" href="job-details.php?myid=<?php echo $value['id'];?>" target="new window"><?php echo $value['jtitle'];?></a></h3>
            <span class="card__tagline"><a href="https://www.youtube.com" style="text-decoration:none;color: #474747;"><?php echo $value['company']?></a></span>            
            <span class="card__status"><?php echo $value['location']?></span><br>
            <!-- <span class="card__status"><?php echo $value['employer_title']?></span> -->
          </div>
        </div>
        <div class="card_description">
        <p>
        <a style="color: black;font-weight:800;">Posted by: </a><i><?php echo $value['employer_name']?></i><br>
            <!-- <span class="tab" style=""></span> -->
            <i><?php echo $value['employer_title']?><br></i><br>
            <!-- <span class="tab" ></span> -->
        <a><i style=""class="fa fa-briefcase"></i> <?php echo $value['jtype'];?></a>
          <!-- <br><a style="color: black;font-weight:800">Description: </a><?php echo $value['jdesc']?> -->
          <!-- <br><a style="color: black;font-weight:800">Age: </a><?php echo $value['age'];?> -->
          <br><a style="color: black;font-weight:800">Education: </a><?php echo $value['education'];?>
          <br><a style="color: black;font-weight:800">Experience: </a><?php echo $value['experience'];?>
          <br><a style="color: black;font-weight:800">Pay Range:  </a>
            <a style="color: black;font-weight:800;border:1px solid black;border-radius:20px;padding-left:5px;padding-right:5px;margin-left:1%"> <?php echo $value['pay'];?> </a>
          <br><br>
          <?php
          $jid = $value['id'];
          if( checkJobs(  $_SESSION['id'], $jid, $con ) ) :
            
	        ?>
		      <form method="post" style="position:absolute;width:50%;left:25%;top:85%">
            <button type="submit" name="remov" class="btn" style="width:100%;background-color:gray" value="<?php echo $value['id'];?>">
			        <img style="transform:translate(-15%,12.5%)" height=40 width=40 src="chettha.png">
			        <span style="font-family: 'Work Sans', sans-serif;font-size: 13px;">Applied</span>
            </button>
        	</form>
          <?php elseif($_SESSION['utype'] == 2 || $_SESSION['utype'] == 3):?>
          <form method="post" style="position:absolute;width:50%;left:25%;top:85%">
            <button class="btn" style="width:100%;background-color:black">
			        <!-- <img style="transform:translate(-15%,12.5%)" height=40 width=40 src="chettha.png"> -->
			        <span style="font-family: 'Work Sans', sans-serif;font-size: 13px;">Boss Cant Apply</span>
            </button>
	        </form>
          <?php else:?>
            <form method="post" style="position:absolute;width:50%;left:25%;top:85%">
              <button type="submit" name="appl" class="btn" style="width:100%;" value="<?php echo $value['id'];?>">
                <img style="transform:translate(-15%,12.5%)" height=40 width=40 src="chettha.png">
                <span style="font-family: 'Work Sans', sans-serif;font-size: 13px;">Apply Now</span>
              </button>
        	</form>
          <?php endif;?>
        </p>
  </div>

          

      </div>
    <!-- </a> -->
  </li>
  <?php }?>
</ul>
</div>
<br>
<div >
  <h1 style="text-align:center">Hot Jobs</h1>
  <ul class="toppies">
  <?php
    $qq = "SELECT j.* FROM `jobs` AS j JOIN `applier` AS a ON a.jobid = j.id GROUP BY a.jobid ORDER BY COUNT(a.jobid) DESC LIMIT 3";
    $result = $con->query($qq);
    foreach($result as $value){
  ?>
    
      <li class="toppie">
            <h3 class="card__title"><a style="text-decoration:none;color:white" href="job-details.php?myid=<?php echo $value['id'];?>" target="new window"><?php echo $value['jtitle'];?></a></h3>
            <span class="card__tagline"><a style="text-decoration:none;color: #dddddd;"><?php echo $value['company']?></a></span>            
            <span class="card__status" style="color:#dddddd"><?php echo $value['location']?></span><br>
    </li>
    
  <?php }?>
  </ul>
</div>

</body>


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
</html>