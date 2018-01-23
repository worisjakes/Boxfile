<?php
session_start();
$db_name = "boxfile";
$db_password = "";
$db_serveruser="localhost";
$db_username ="root";
$email =$password ="";
$conn = mysqli_connect($db_serveruser, $db_username, $db_password, $db_name);
if($conn){
    if(!empty($_POST["email"]) && !empty($_POST["password"])){
        $email = $_POST["email"];
        $password =$_POST["password"];
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count==1){
            echo "success";
            $_SESSION["name"] = $email;

        }else{
            echo "Email or password does not exist";
        }

    }else{
        echo "Fields cannot be empty";
    }
}
?>