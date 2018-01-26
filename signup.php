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
    $name = strip_tags(trim(htmlspecialchars($name)));
    $name= mysqli_real_escape_string($conn, $_POST["name"]); 
    $phoneNum = strip_tags(trim(htmlspecialchars($phoneNum)));
    $phoneNum= mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = strip_tags(trim(htmlspecialchars($email)));
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $school = strip_tags(trim(htmlspecialchars($school)));
    $school= mysqli_real_escape_string($conn, $_POST["school"]);
    $level = strip_tags(trim(htmlspecialchars($level)));
    $level= mysqli_real_escape_string($conn, $_POST["level"]);
    $password = strip_tags(trim(htmlspecialchars($password)));
    $password= mysqli_real_escape_string($conn, $_POST["password"]);
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
                $_SESSION["name"] = $email;
                echo "1";

            }else{
                echo "Error". mysqli_error($conn);
            }
        }
    }
}else{
    echo "Fields cannot be empty!!";
}
}else{
 die("Connection failed:". mysqli_connect_error());
}
mysqli_close($conn);
?>i