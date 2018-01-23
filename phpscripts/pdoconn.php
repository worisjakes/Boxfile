<?php
 $host ="localhost";
 $user ="root";
 $password ="";
 $dbname="boxfile";
 $dsn ="mysql:host=". $host.";dbname=".$dbname;
 $conn = new PDO($dsn, $user,$password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>