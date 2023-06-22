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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="login-styleA.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "databaseA.php";
            $sql = "SELECT * FROM farmer WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: admin.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
      <form action="loginA.php" method="post">
        <div class="box">
                <div class="row">
                    <div class="col-sm-5 col-xs-1 box1">
                        <div class="inline-text">
                            <h1><b><i>Login</i></b></h1>
                            <p><b>Get Access to your orders,<br>
                                Wishlist and<br>
                                Recommendations<br>
                            </b></p>
                            <pre>

                            </pre>
                            <div style="text-align: center;">
                                <img src="logob.png" width="250" alt="My Image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 col-xs-1 box2">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control">
                            <label>Enter email/Mobile Number</label>
                        </div>
                        <div class="form-group">
                            <input type="password"  name="password" class="form-control">
                            <label>Enter Password</label>
                        </div>
                        <div class="form-btn">
                            <input type="submit" value="Login" name="login" class="btn btn-primary" action="">
                        </div>
                    </div>
                </div>
        </div>
       </form>
        <div><p>Not registered yet <a href="registrationA.php">Register Here</a></p></div>
    </div>
</body>
</html>