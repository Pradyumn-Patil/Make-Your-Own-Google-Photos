<?php
$con=mysqli_connect('localhost','root','','questions');
mysqli_select_db($con, 'questions') or die(mysqli_error($con));
?>