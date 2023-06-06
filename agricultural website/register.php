<?php
    session_start();
    header('location:signup.html');
    $con=mysqli_connect('localhost','root');
    if($con){
        echo "Connection Successfully";
    }
    else{
        echo "No connection";
    }
    mysqli_select_db($con,'agricultural-website');
    $name = $_POST['email'];
    $pass = $_POST['password'];

    $quer="Select * from userdata where username = '$name' && password = '$pass'";
    $result=mysqli_query($con,$quer);
    $num=mysqli_num_rows($result);
    if($num==1)
    {
        echo "Duplicate Data";
    }
    else{
        $querr="insert into userdata(username,password) values('$name','$pass')";
        mysqli_query($con,$querr);
    }
?>