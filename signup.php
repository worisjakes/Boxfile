<?php
session_start();
$db_name = "boxfile";
$db_password = "";
$db_serveruser="localhost";
$db_username ="root";
$name= $phoneNum= $email= $school= $level= $gender= $password ="";
$msg = "";
$conn = mysqli_connect($db_serveruser, $db_username, $db_password, $db_name);
if($conn){
if(isset($_POST["clicked"])  && !empty($_POST["name"]) && !empty($_POST["phone"]) && !empty($_POST["email"] )&& !empty($_POST["gender"])&& !empty($_POST["school"]) && !empty(["level"])){
    $name = $_POST["name"]; 
    $phoneNum = $_POST["phone"];
    $email = $_POST["email"];
    $school = $_POST["school"];
    $level = $_POST["level"];
    $password = $_POST["password"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)=== FALSE && $phoneNum < 11 && $password<=6){
        echo "Email or phone number incorrect or password incorrect";
    }else{
        $query = "SELECT email FROM users WHERE email ='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if($count>0){
           echo "Email already exist in database";
        }else{
            $sql = "INSERT INTO users(email, phoneNum, password,name,level,school,gender) VALUES('$email','$phoneNum','$password','$name', '$level','$school','$gender')";
            if(mysqli_query($conn, $sql)){
                $_SESSION["name"] = $name;
                echo "1";

            }else{
                echo "Error". mysql_error();
            }
        }
    }
}else{
    echo "Fields cannot be empty!!";
}
}else{
 die("Connection failed:". mysqli_connect_error());
}
?>