<html>
<head>
    <link rel="stylesheet" href="stylyl.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
    <style>
        .container{
            padding-left: 10px ;
        }
    </style>
</head>
<body>
<?php
        include("joblink.php");
        include("login.php");
        if(!isset($_SESSION['user_name'])){
            header("Location: index.php");
        }
    ?>
	<a style="position: fixed" href="homie.php"><img class="thumbnail" height=100 width=100 src="chettha.png"></a>
    <a style="float: right"><img class="user dog" style="transform: translate(-30%,10%);width:68px;height:68px;" src=" <?php echo $_SESSION['propic'];?> "></a>
    <h1 style="text-align: center;padding-top: 30px;">Account and Settings</h1>
	<div class="container">
        <div class="profile-container">
            <form action="homie.php" method="post">
                <!-- <a>Full Name: </a><br>
                <input name="name" placeholder="Enter Name..." type="text">
                
                 -->
                <a>Upload Image URL: </a><br>
                <input name="imgurl" placeholder="Image URL..." type="text"  /><br><br>
                <a>Education: </a><br>
                <input name="educ" placeholder="Highest Education..." type="text"  />
                <!-- <a>Location: </a><br>
                <input name="loca" placeholder="Current Location..." type="text"  /> -->
                <!-- <br><br>
                <a>Upload Image URL: </a><br>
                <input name="imgurl" placeholder="Image URL..." type="text" required /> -->
                <br><br>
                <button type="submit" name="subbed">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>