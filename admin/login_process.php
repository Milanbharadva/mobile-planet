<?php
session_start();
include('./include/config.php');
extract($_POST);
$qry = "SELECT * FROM admin WHERE email='" . $email . "'&& password='" . md5($password) . "'";
$res = mysqli_query($conn, $qry);
$count = mysqli_num_rows($res);
if ($count > 0) {
    $_SESSION['email'] = $email;
    header("location:dashboard.php");
} else {
    header("location:index.php");
}
