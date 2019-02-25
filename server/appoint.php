
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <title>Appointment</title>
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
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
	<div class="container " style=" max-width: 600px; background-color:rgba(47, 42, 117, 0.02)">
        <br>
        <h3 class="lead" style="text-align: center">Appointment</h3>
        <h3 class="form-signin-heading" style="text-align: center">Make an Appointment with Dr. Ted Mosby</h3>
        <br>
        <?php
        	require_once 'core.inc.php';
        	$query = "SELECT number FROM appoint_number WHERE id=1";
	        $query_run = mysqli_query($mysql_con, $query);
	        while ($row = mysqli_fetch_assoc($query_run)) {
	            $number = $row['number'];
	        }

	        if($number < 30)
	        {
	        	?>
	        	<form method="GET" action="appoint_take.php">
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Name</label>
				    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter the name of the patient" name="name">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Age</label>
				    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter the age of the patient" name="age">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Sex</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="sex">
				      <option value="Male">Male</option>
				      <option value="Female">Female</option>
				      <option value="Others">Others</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Previous Patient Id (If you have)</label>
				    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter the patient Id" name="previous_id">
				  </div>
				  <div class="form-group">
				    <input type="submit" class="btn btn-outline-success btn-block" name="submit">
				    <input type="reset" class="btn btn-outline-primary btn-block">
				    
				  </div>
				</form>
				<?php
	        }
	        else {
	        	?>
        			<h2 class="text-danger pb-5 text-center">Today's Appointment is closed.</h1>
	        		
	        	<?php
	    	}
        ?>
        
    </div>
	

	
	
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>