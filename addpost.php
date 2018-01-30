<?php 
session_start();
require("phpscripts/pdoconn.php");
if(isset($_POST["submit"])){
	$id = $_POST['hidden'];
	if(!empty($_POST['editor1']) && !empty($_POST["comments"])){
	$post = $_POST['editor1'];
	$comment = $_POST["comments"];
	try{
	$stmt = $conn->prepare("UPDATE project SET Posts =:post WHERE ProjectId =:id");
	$stmt -> execute(["post"=>$post, "id"=>$id]);
	$sql = $conn->prepare("UPDATE members SET editComment =:comment WHERE  userId = :userid AND project_id =:projectid ");
	$sql->execute(["comment"=>$comment, "userid"=>$_SESSION['id'], "projectid"=>$id]);
	echo "SUCCESSFULL";
}catch(PSOException $e){
	echo $e->getMessage();
}
}else{
	echo "You cant sumit an empty comment or post";
}
}
?>