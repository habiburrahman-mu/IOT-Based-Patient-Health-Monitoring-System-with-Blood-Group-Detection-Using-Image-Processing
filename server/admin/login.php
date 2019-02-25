<?php
require_once 'core.inc.php';
if (isset($_SESSION['admin_username']) ){
    header("location: index.php?msg=You're Already logged in");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Admin Log In</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="jumbotron">
            <h3 class="lead" style="text-align: center">Login to Admin panel</h3>
        </div>
        
        <?php 
        if(isset($_GET['msg']) && !empty($_GET['msg'])){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                <strong><?php echo $_GET['msg'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }

        ?>
        <div class="container" style=" max-width: 400px; background-color:rgba(47, 42, 117, 0.02)">
            <br>
            <h3 class="lead" style="text-align: center">Admin Login</h3>
            <h3 class="form-signin-heading" style="text-align: center">Please Enter Id & Password</h3>
            <form class="form-signin" method="POST" action="">
                
                <label for="inputEmail" class="sr-only">Username</label>
                <input id="inputEmail" class="form-control" required autofocus name="user" type="text" placeholder="Please Enter your Username">
                <br>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" required name="pass" placeholder="Please Enter Your Password">
                <br>
                <input class="btn btn-lg btn-outline-primary btn-block" type="submit" name="submit">
                <br>
            </form>
        </div>
        <?php
        
        if (isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['pass']) ) {
            $username = $_POST['user'];
            $password = $_POST['pass'];
            if (!empty($username) && !empty($password )) {
                $query = "SELECT name FROM admin_table WHERE username='$username' AND password='$password' ";
                $query_run = mysqli_query($mysql_con, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $_SESSION['admin_username'] = $username;
                        header("location: index.php");
                    }
                } else {
                    header("location: login.php?msg=Wrong Username or Password");
                }
            } else {
                header("location: login.php?msg=Username or Password cannot be empty");
            }
        }
        ?>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>