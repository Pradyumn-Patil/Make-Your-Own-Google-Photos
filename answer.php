<?php
$con=mysqli_connect("localhost","root","","questions") or die(mysqli_error($con));
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
		</nav>
		<div class="form-layout">
			<div class="column">
				<h1 class="col-sm-12 form-heading">Discussion</h1>
				<div class="form-style">
				 <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">;
					<div class="form-group">
						<textarea name="comment" placeholder="Type your comment" class="form-control",id="comment" rows="3"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Post</button>
					</div>
				</form>
				<?php
					$con=mysqli_connect("localhost","root","","questions") or die(mysqli_error($con));
					$question_id=$_GET['question_id'];
					$sql="select * from `answers` where question_id=$question_id";
					$result=mysqli_query($con,$sql);
					$noresult=true;
					while($rows=mysqli_fetch_assoc($result))
					{
						$noresult=false;
					?>
						<div class="card question-body">
							<div class="card-body">
								<h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i><?php echo $rows['username']; ?>
								<p class="card-text"><?php echo $rows['comment']; ?>
								<p class="card-text"><small class="text-muted"><?php echo $rows['time']; ?></small></p>
							</div>
						</div>
					<?php
					}
					?>
					<?php
						$question_id=$_GET['question_id'];
						session_start();
						$username= $_SESSION["username"];
						$comment=$_POST['comment'];
						if($comment)
						{
							$insert = "insert into `answers`(`question_id`,`username`,`comment`,`time`) values('$question_id','$username','$comment',current_timestamp())";
							$result = mysqli_query($con,$insert);
							header("Location:/student.php");
						}
					?>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
</html>