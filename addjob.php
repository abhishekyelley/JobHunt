<html>
<head>
    <link rel="stylesheet" href="stylyl.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Job Hunt</title>
    <style>
        body{
                align-items: center;
                background-color: #000;
                display: flex;
                justify-content: center;
                height: 100vh;
        }
        input[type="text"]{
            background-color: #303245;
            border-radius: 12px;
            border: 0;
            box-sizing: border-box;
            color: #eee;
            width: 100%;
            font-size: 18px;
            height: 5%;
            outline: 0;
            padding: 4px 20px 0;
            width: 100%;
        }
        /* input[type="submit"]{
            
        } */
        .hovy{
            background-color: white;
            border-radius: 12px;
            border: 0;
            box-sizing: border-box;
            color: black;
            width: 100%;
            font-size: 18px;
            height: 5%;
            outline: 0;
            padding: 4px 20px 0;
            width: 100%;
            box-shadow: 0 14px 50px rgb(44, 31, 31), 0 10px 10px rgb(65, 43, 43);
            transition: 0.3s all;
        }
        .hovy:hover{
            background-color: gray;
            /* color: white; */
            cursor: pointer;
            box-shadow: none;
        }
        .hovy:active{
            background-color: black;
            color: white;

        }
    </style>
</head>
<body>
<!--
<script type="text/javascript">
  function closeSelf () {
     window.close();
  }
</script>
-->
    <?php
    include("joblink.php");
    include("login.php");
    if(!isset($_SESSION['user_name'])){
        header("Location: index.php");
    }
    if($_SESSION['utype'] == 1){
        header("Location: homie.php");
    }
        if(isset($_GET['submit'])){
            $jtitle = $_GET['jtitle'];
            $location = $_GET['location'];
            $jtype = $_GET['jtype'];
            $company = $_GET['company'];
            $employer_name = $_SESSION['fname']." ".$_SESSION['lname'];
            $employer_title = $_GET['employer_title'];
            $jdesc = $_GET['jdesc'];
            $age = $_GET['age'];
            $education = $_GET['education'];
            $experience = $_GET['experience'];
            $pay = $_GET['pay'];
            $com_pic = $_GET['com-pic'];
            $emp_pic = $_SESSION['propic'];
            $cre = $_SESSION['id'];
            $qry = "INSERT INTO `jobs` ( `creator`, `jtitle`, `location`, `jtype`, `company`, `employer_name`, `employer_title`, `jdesc`, `age`, `education`, `experience`, `pay`, `com-pic`, `emp-pic`) VALUES ( '$cre','$jtitle', '$location', '$jtype', '$company', '$employer_name', '$employer_title', '$jdesc', '$age', '$education', '$experience', '$pay', '$com_pic', '$emp_pic')";
            $result = $con->query($qry);
        }
    ?>
    <form method="GET" >
        <br>
        <input type="text" name="jtitle" placeholder="Job Title" required/><br><br>
        <input type="text" name="location" placeholder="Location" required/><br><br>
        <input type="text" name="jtype" placeholder="Job Type"required /><br><br>
        <input type="text" name="company"  placeholder="Company Name" required/><br><br>
        <!-- <input type="text" name="employer_name"  placeholder="Employer Name" required/><br><br> -->
        <input type="text" name="employer_title"  placeholder="Employer Title" required/><br><br>
        <input type="text" name="jdesc"  placeholder="Job Description" required/><br><br>
        <input type="text" name="age"  placeholder="Age Required" required/><br><br>
        <input type="text" name="education"  placeholder="Minimum Education" required/><br><br>
        <input type="text" name="experience"  placeholder="Experience Required" required/><br><br>
        <input type="text" name="pay"  placeholder="Pay Range" required/><br><br>
        <input type="text" name="com-pic"  placeholder="Company Picture Link" required/><br><br>
        <!-- <input type="text" name="emp-pic"  placeholder="Employer Picture Link" required/><br><br> -->
        <input type="submit" class="hovy" name="submit" value="Upload" />
    </form>
    <?php
        $con -> close();
    ?>
</body>
</html>








