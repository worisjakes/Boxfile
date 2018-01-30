<?php 
session_start();
require("phpscripts/pdoconn.php");
if(!empty($_POST["email"])){ 
	$projid = $_POST['hidden1']; 
	$email = $_POST['email'];
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$query = $conn->query($sql);
	$row = $query->fetch();
	if($query->rowCount()>0){
		$id =  $row->id;
		try{
			$rowquery = "SELECT memberId from members INNER JOIN users WHERE userId = ".$_SESSION['id']." AND project_id='$projid'";
			$result = $conn->query($rowquery);
			$rows = $result ->rowCount();
			if($rows>0){
				echo "User already added to project";
			}else{
		$stmt =$conn->prepare("INSERT INTO members(project_id, userId, project_name) VALUES (:procjectid, :userid, :project_name)");
		$stmt->execute(["procjectid"=> $_POST["hidden1"], "userid"=>$id, "project_name"=> $_POST['hidden2']]);
		echo "1";

			}
		}catch(PDOException $e){
			echo $e-> getMessage();
		}
		
	}else{
		echo "No user found, invite sent";
	}
}else{
	echo "No email submited";
}
?>