<?php
$con=mysqli_connect("localhost","root","","questions") or die(mysqli_error($con));
$question_id=$_GET['question_id'];
$comment=$_POST['comment'];
session_start();
$username= $_SESSION["username"];
$insert = "insert into `answers`(`comment`,`question_id`,`username`,`time`) values('$comment','$question_id','$username',current_timestamp())";
	$r = mysqli_query($con,$insert)  or die("failed ".mysqli_error($con));
?>