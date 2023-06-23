<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="login-style.css">
    <title>User Logout</title>
</head>
<body>
    <div class="container">
    <form action="login.php" method="post">
        <div class="box">
                <div class="row">
                    <div class="col-sm-5 col-xs-1 box1">
                        <div class="inline-text">
                            <h1><b><i>Logging Off from 
                                <br>the Farm Life</i></b></h1>

                            <pre>

                            </pre>
                            <div style="text-align: center;">
                                <img src="logob.png" width="250" alt="My Image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 col-xs-1 box2">
                        <div class="form-group">
                        <p style="font-size: 20px; width: 200px;  white-space: nowrap; ">Are you sure you want to log out?</p>
                        <a href="logout.php" class="btn btn-warning">Logout</a>
                        </div>
                    </div>
                </div>
        </div>
       </form>
    </div>
</body>
</html>