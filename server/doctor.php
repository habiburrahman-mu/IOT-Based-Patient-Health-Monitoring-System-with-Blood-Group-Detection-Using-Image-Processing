<?php
  require_once 'core.inc.php';
  header('Refresh: 5'); 
  $query = "SELECT * FROM appoint_number WHERE id=1";
  $query_run = mysqli_query($mysql_con, $query);
  while ($row = mysqli_fetch_assoc($query_run)) {
      $serial_number = $row['serial_no'];
      $total_patient_number = $row['number'];

  }
  $query = "SELECT * FROM appointment WHERE serial_no='$serial_number'";
  $query_run = mysqli_query($mysql_con, $query);
  $patient_id="";
  while ($row = mysqli_fetch_assoc($query_run)) {
      //var_dump($row);
      $patient_id = $row['previous_id'];
      $name = $row['name'];
      $age = $row['age'];
      $sex = $row['sex'];
  }
  $blood_group ="";
      $temp = "";
      $heart_rate = "";
  if($patient_id)
  {
    $query = "SELECT * FROM patient_table WHERE patient_id='$patient_id'";
    $query_run = mysqli_query($mysql_con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        //var_dump($row);
      $blood_group = $row['blood_group']=='n' ? 'No Data Found':$row['blood_group'];
      $temp = $row['temp']=='0' ? 'No Data Found':$row['temp'];
      $heart_rate = $row['heartrate']=='0' ? 'No Data Found':$row['heartrate'];
    }
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

    <title></title>
  </head>
  <body>
    <div class="bg-success text-center p-3">
      <h3 class="text-center">Remaining: <?=($rem=$total_patient_number-$serial_number+1)?></h3>
    </div>
    <?php
      if($serial_number>$total_patient_number ) {
        die('<h1 class="text-center mt-4 ">No Patient</h1>');
      }
      if($serial_number==0)
      {
        die('<h1 class="text-center mt-4 ">Push the serial button</h1>');
      }
      
    ?>
    <div class="p-4">
        <div class="row fluid" >
          <div class="col col-md-7">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Serial No</th>
                  <th scope="col"><?=$serial_number?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Name</th>
                  <td><?=$name?></td>
                </tr>
                <tr>
                  <th scope="row">Patient Id</th>
                  <td><?=$patient_id?></td>
                </tr>
                <tr>
                  <th scope="row">Age</th>
                  <td><?=$age?></td>
                </tr>
                <tr>
                  <th scope="row">Sex</th>
                  <td><?=$sex?></td>
                </tr>
              </tbody>
            </table>
            <hr>
            <h4 class="bg-info p-2">Medical Information</h4>
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Blood Group</th>
                  <td><?=$blood_group?></td>
                </tr>
                <tr>
                  <th scope="row">Temperature</th>
                  <td><?=$temp?> *F</td>
                </tr>
                <tr>
                  <th scope="row">Heart Rate</th>
                  <td><?=$heart_rate?> BPM</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col col-md-5">
            <h4 class="bg-dark p-2 text-white text-center">Next Patient List</h4>
            <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">Serial</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Sex</th>
                <th scope="col">Previous Id</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $query = "SELECT * FROM appointment ORDER BY serial_no";
                $query_run = mysqli_query($mysql_con, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                  if($row['serial_no']==$serial_number){
                    continue;
                  }
                  //var_dump($row);
                  ?>
                  <tr>
                    <th scope="row"><?=$row['serial_no']?></th>
                    <td><?=$row['name']?></td>
                    <td><?=$row['age']?></td>
                    <td><?=$row['sex']?></td>
                    <td><?=$row['previous_id']?></td>
                  </tr>
                  <?php
                }
              ?>
              
            </tbody>
          </table>
          </div>  
        </div>
      </div>
	
	
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>