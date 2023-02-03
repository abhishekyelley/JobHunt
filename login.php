<?php
    session_start();
    $con = new mysqli("localhost", "root", "", "jobhunt2db");
    if(isset($_POST['log-in-btn'])){
        if(isset($_POST['uname']) && isset($_POST['password'])) {
            $uname = $_POST['uname'];
            $pass = $_POST['password'];
        }
        else{
            header("Location: index.php");
            exit();
        }

        $qry = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($con, $qry);
        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['utype'] = $row['utype'];
                $_SESSION['propic'] = $row['propic'];
                header("Location: homie.php");
                exit();
            }
            
        }
        else{
            header("Location: index.php?invalid=1");
        }
    }

    function checkJobs($uid,$jid,$con){
        $jqry = "SELECT * FROM `applier` WHERE `jobid` = '$jid' AND `userid` = '$uid'";
        $jres = mysqli_query($con, $jqry);
        if(mysqli_num_rows($jres) > 0){
            return true;
        }
        return false;
    }

    function createAccount($finame,$laname,$usname,$pswd,$ustype,$con){

        $insqry = "INSERT INTO `users` ( `user_name`, `fname`, `lname`, `password`, `utype`) VALUES ('$usname', '$finame', '$laname', '$pswd', '$ustype')";
        $safety = "SELECT * FROM users WHERE user_name='$usname'";
        $result = mysqli_query($con, $safety);
        if(mysqli_num_rows($result) === 0)
            return $con->query($insqry);
    }
?>