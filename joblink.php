<?php
    $con = new mysqli("localhost", "root", "", "jobhunt2db");
    $result = $con->query("SELECT * FROM jobs");
?>
    