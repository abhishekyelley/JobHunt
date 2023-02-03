<html>
<head>
    <link rel="stylesheet" href="stylyl.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
    <style>
    </style>
</head>
<body>
    
    <style>
        body{
        }
    </style>
    <?php
        include("login.php");
        if(!isset($_SESSION['user_name'])){
            header("Location: index.php");
        }
    ?>
	<a style="position: fixed" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>
	<div class="container">
        
        <div class="nav">
                <a href="homie.php"><i class="fa fa-home"></i><br>Home</a>
                <a href="jobbie.php"><i class="fa fa-briefcase"></i><br>Jobs</a>
                <a class="bongu" href="peopley.php"><i class="fa fa-child"></i><br>People</a>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <a href="homie.php?logout='1'"><i class="fa fa-sign-out"></i><br>LogOut</a>
                <?php endif ?>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <a href="profiley.php">Hi,<br><?php echo $_SESSION['fname'] ?></a>
                <?php endif ?>
		</div>
        <div class="peep-job">
            <?php
                if( $_SESSION['utype'] == 2) :
                    $uid = $_SESSION['id'];
                    $qry = "SELECT * FROM `jobs` WHERE `id` IN (SELECT `id` FROM `jobs` WHERE `creator` = '$uid')";
                    $result = $con->query($qry);
                    if(mysqli_num_rows($result) > 0):
                        foreach($result as $value){ ?>
                        <a href="peopley.php?myid=<?php echo $value['id'];?>">
                            <li>
                                <biggy  style="font-size:20" ><?php echo $value['jtitle'];?></biggy><br>
                                <a style="font-size:14;color: black;"><?php echo $value['company'];?></a>
                                <br>
                                <a  style="font-size:12;color: black;" ><?php echo $value['location'];?></a>
                            </li>
                        </a>
                <?php } endif; 
                elseif( $_SESSION['utype'] == 3 ):
                    $qry = "SELECT * FROM `jobs`";
                    $result = $con->query($qry);
                    if(mysqli_num_rows($result) > 0):
                        foreach($result as $value){ ?>
                            <a href="peopley.php?myid=<?php echo $value['id'];?>">
                                <li>
                                    <biggy  style="font-size:20;font-weight:800;" ><?php echo $value['jtitle'];?></biggy><br>
                                    <a style="font-size:14;color: black;"><?php echo $value['company'];?></a>
                                    <br>
                                    <a  style="font-size:12;color: black;" ><?php echo $value['location'];?></a>
                                </li>
                            </a>
                <?php }endif; 
                else:
                    ?>
                    <h2 style="margin-left:32%;color: red">Be an Employer!</h2>
                <?php endif; ?>

        </div>
        <div class="people-container">
            <a style="font-weight:800 ;">People enrolled for job:</a><br><br>
            <?php
                    if(isset($_GET['myid'])) {
                        $jid = $_GET['myid'];
                        $eqry = "SELECT * FROM `users` WHERE `id` IN (SELECT `userid` FROM `applier` WHERE `jobid` = '$jid')";
                        $result = $con -> query($eqry);
                        foreach($result as $value){ ?>
                            <div  class="manishi">
                                
                                <img src="<?php echo $value['propic'];?>">
                                <a><?php echo  $value['fname']," ",$value['lname']?></a>
                                <p><span style="font-weight: 800">Email: </span><i><?php echo $value['user_name']?></i><br>
                                <?php $aidy = $value["id"];
                                $haha = $con->query("SELECT `education` FROM `extradetails` WHERE `userid` = '$aidy'");
                                if(mysqli_num_rows($haha)===0):?>
                                Assistant To The Regional Manager<br>Dunder Mifflin</p>
                                <?php else:
                                    $row = $haha -> fetch_assoc();
                                    echo $row["education"];?><br>Dunder Mifflin</p>
                                <?php endif;?>
                                <button id="<?php echo $value['id']?>" onclick="addFriend('<?php echo $value['id']?>','<?php echo $value['user_name']?>')" ><i class="fa fa-user-plus"></i> Send Mail</button>
                            </div>
                        <?php } } ?>
            <!-- <div class="manishi">
                <img src='kukka.png'>
                <a>Kukkappala Swamy</a>
                <p>Assistant Regional Manager<br>Dunder Mifflin</p>
                <button id="kukka" onclick="addFriend('kukka')"><i class="fa fa-user-plus"></i> Connect</button>
            </div>
            <div class="manishi">
                <img src='monki.jpg'>
                <a>Kothanna Murali</a>
                <p>Assistant Regional Manager<br>Dunder Mifflin</p>
                <button id="kothi" onclick="addFriend('kothi')"><i class="fa fa-user-plus"></i> Connect</button>
            </div>
            <div class="manishi">
                <img src='froggie.jpg'>
                <a>Kappala Papa Rao</a>
                <p>Assistant Regional Manager<br>Dunder Mifflin</p>
                <button id="kappa" onclick="addFriend('kappa')"><i class="fa fa-user-plus"></i> Connect</button>
            </div> -->

            
            

        </div>
    </div>



    <script>
        function addFriend(x,tt){
            var y = document.getElementById(x).innerHTML;
               /* if(y == `<i class="fa fa-user-plus"></i> Connect`){*/
                    document.getElementById(x).innerHTML = `<i class="fa fa-check"></i> Mail Sent`;
                    document.getElementById(x).style.background = "linear-gradient(to right, #f0cc85, #ec8656)";
                    var copyText = tt;
                    navigator.clipboard.writeText(copyText);
                    alert("Copied the email: " + copyText);
               /* else{
                    document.getElementById(x).innerHTML = `<i class="fa fa-user-plus"></i> Connect`;
                    document.getElementById(x).style.background = "linear-gradient(to right, #f386a7, #c494f1)";
                }*/
        }
    </script>

    <br><br>
</body>

<footer style="zindex:50">
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