<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: login-indexA.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="registration-styleA.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "databaseA.php";
           $sql = "SELECT * FROM farmer WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO farmer (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <form action="registrationA.php" method="post">
            <div class="box">
                <div class="row">
                    <div class="col-sm-5 col-xs-1 box1">
                        <div class="inline-text">
                            <h1><b><i>Looks like you're<br>
                            new here!</i></b></h1>
                            <p><b>Sign up with your mobile number<br> 
                                to get started
                            </b></p>
                            <pre>

                            </pre>
                            <div style="text-align: center;">
                                <img src="logob.png" width="250" alt="My Image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-1 box2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fullname">
                            <label for="">Full Name:</label>
                        </div>
                        <div class="form-group">
                            <input type="emamil" class="form-control" name="email" >
                            <label for="">Email Address:</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" >
                            <label>Enter Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="repeat_password" >
                            <label>Repeat Password</label>
                        </div>
                        <pre>

                        </pre>
                        <div class="form-btn">
                            <input type="submit" class="btn btn-primary" value="Register" name="submit">
                        </div>
                        <div class="form-group">
                        <p class="footer"><a href="#">New to Agri-Bussiness? Create an account</a></p>
                        <div><p>Already Registered <a href="loginA.php">Login Here</a></p></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
        <div>
      </div>
    </div>
</body>
</html>