<?php
require_once 'core.inc.php';
$query = "SELECT number FROM appoint_number WHERE id=1";
$query_run = mysqli_query($mysql_con, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
    $number = $row['number'];
}
$state = "enabled";
$class = "primary";
$msg = "Make an Appointment";
if($number >= 30)
{
	$state='disabled aria-disabled="true"';
	$class = "danger disabled";
	$msg = "Appointment Closed";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <title>Dr. Ted Mosby</title>
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php">Dr. Ted Mosby's Office</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="appoint.php">Appointment</a>
			</div>	
		</div>
	</nav>
	<div class="jumbotron text-center">
  		<div class="container">
  			<div class="row fluid" >
				<div class="col col-md-4">
		  			<div class="text-center" >
						<img src="image/ted_index_1.jpg" class="rounded " height="100%" alt="Responsive image">
					</div>
				</div>
				<div class="col col-md-8">
					<h1 class="display-4">Dr. Ted Mosby (Cardiology)</h1>
					<br>
					<p class="lead">Hospital Name : National Institute of Cardiovascular Diseases (NICVD)</p>
					<p class="lead">Degree : MBBS, D-Card(London) FACC(America)</p>
					<p class="lead">Working Address : Imperial Ornate, Flat A-3, 21/6 Khilzi Road, Mohammdpur, Dhaka-1207.</p>
					<p class="lead"><b>Visiting Hours</b></p>
					<hr class="my-1">
					<p class="lead">Every Day</p>
					<p class="lead">7.00PM - 10.00PM</p>
					<a class="btn btn-<?php echo $class ?> " href="appoint.php" role="button" <?php echo $state ?>><?php echo $msg ?></a>
		  		</div>	
			</div>
  		</div>
  	</div>
  	<hr class="my-4 ">
  	<p class="lead container text-justify">
  		Ted Mosby is an American cardiologist. He was a member of the Medical Corps from 2008 to 2015. He received "William Osler Medal" for the History of medicine in 2011. He also received "Pam and Rolando Del Maestro William Osler Medical Students Essay Awards" in 2013. In 2016, he received "Student Award in Oslerian Medicine".
  	</p>
	<div class="text-center mb-2">
		<img src="image/ted_index_2.jpg" width="auto" height="200px" class="rounded " alt="...">
		<img src="image/ted_index_3.jpg" width="auto" height="200px" class="rounded" alt="...">
		<img src="image/ted_index_4.jpg" width="auto" height="200px" class="rounded" alt="...">
		<img src="image/ted_index_6.jpg" width="auto" height="200px" class="rounded" alt="...">
	</div>	
	<hr class="my-4 ">

	
	
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>