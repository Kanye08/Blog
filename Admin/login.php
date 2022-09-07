<?php
include("dbconnect.php");
include("function/sessions.php");
include("function/redirect.php");


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $username = $_POST['username'];


    if (empty($email) && empty($pass)) {
        $_SESSION['errorMessage'] = "All input fields cannot be empty!";
        redirectTo("login.php");
    }
    global $con;
    $getAdmin = "SELECT * FROM admin WHERE Email = '$email' AND Password = '$pass' AND Username ='$username'";
    $queryLogin = mysqli_query($con, $getAdmin);
    if ($exe = mysqli_fetch_array($queryLogin)) {

        $_SESSION['user_id'] = $exe['Id'];
        $_SESSION['user_username'] = $exe['Username'];
        $_SESSION['user_email'] = $exe['Email'];
        $_SESSION['successUser'] = "Welcome {$_SESSION['user_username']}";
        redirectTo("Dashboard.php");
    } else {
        $_SESSION['errorMessage'] = "Session Denied!";
        redirectTo("login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <?php
    echo errorMessage();
    echo successMessage();
    ?>
    <div style="background-color:white; transform:translateY(70%);" class="col-sm-offset-4 col-sm-4">

        <h3 style="color:teal; text-align:center; font-weight:600;">Login to dashboard</h3>

        <form action="" method="post">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <input type="text" name="username" class="form-control" id="exampleInputAmount" placeholder="Username">
            </div>

            <br>

            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                <input type="email" name="email" class="form-control" id="exampleInputAmount" placeholder="Email">
            </div>

            <br>

            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></div>
                <input type="password" name="pass" class="form-control" id="exampleInputAmount" placeholder="Password">
            </div>

            <br>

            <button type="submit" name="submit" class="btn btn-info btn-block">Login</button>
        </form>

    </div>



</body>

</html>