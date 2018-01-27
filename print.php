<?php
session_start();
require("phpscripts/pdoconn.php");
$name = $_SESSION['name'];
$id =$_SESSION['id'];
$filename =$_POST['filename'];
$query ="SELECT fileName FROM files WHERE fileName  ='$filename'";
$result = $conn->query($query);
$file;
while($row=$result->fetch()){
	$file = $row ->fileName;
}
	if(!empty($_POST['address']) && !empty($_POST['pageno']) && !empty($_POST['copies']) && !empty($_POST['attachpass'])){
	$address = $_POST["address"];
	$pageno = $_POST["pageno"];
	$copies = $_POST["copies"];
	$attachpass = $_POST["attachpass"];
	try{
	$sql = "INSERT INTO printreq(printAddress, pagesNum, CopyNum,Attachdoc, user_id, FileName) VALUES(:address, :pageno, :copies, :attachpass, :name, :file) ";
	$stmt = $conn ->prepare($sql);
	$stmt->execute(['address'=>$address, 'pageno'=>$pageno, 'copies'=>$copies, 'attachpass'=>$attachpass,'name'=>$id, 'file'=>$file]);
	echo "success";
}catch(PDOException $e){
	echo $e->getMessage();
}
}
?>