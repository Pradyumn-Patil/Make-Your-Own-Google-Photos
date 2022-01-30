<?php 
session_start();
include_once('connection.php');
$con = mysqli_connect("localhost","root","","questions")or die(mysqli_error($con));
$query="select * from questions";
$result=mysqli_query($con,$query);
?>
<!DOCTYPE html> 
<html>
	<head>
		<title>Student Connect</title>
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
		<script src="https://use.fontawesome.com/b3a33e0934.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="/">Student Connect</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto">
						<a class="nav-item nav-link" href="signup.html">Sign Up</a>
						<a class="nav-item nav-link" href="login.html">Login</a>
						<a class="nav-item nav-link" href="logout.php">Logout <?php 
						echo  $_SESSION["username"]?> </a>
				</div>
			</div>
		</nav>

		<div class="container index-page">
			<header class="jumbotron">
				<div class="container">
					<h1>Welcome To Student Connect!</h1>
					<p>Ask your queries, Help others by posting answers, Boost your knowledge</p>
					<div>
						<a class="btn btn-primary btn-sm" href="ask.html">Ask a Question</a>
					</div>
				</div>
			</header>
			<?php
			while($rows=mysqli_fetch_assoc($result))
			{
			?>
			<div class="card question-body">
				<div class="card-body">
					<h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i><?php echo $rows['username']; ?>
					<h5 class="card-title"><?php echo $rows['title']; ?></h5>
					<p class="card-text"><?php echo $rows['description']; ?>
					<p class="card-text"><?php echo $rows['tags']; ?>
					<div class="navbar-nav">
					<?php echo '<a href="answer.php?question_id='.$rows['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>comment</a>';?>
				</div>
					<p class="card-text"><small class="text-muted"><?php echo $rows['created']; ?></small></p>
					</div>
			</div>
			<?php
			}
			?>
				</div>
			</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	</body>
</html>