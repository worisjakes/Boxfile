<?php
session_start();
require("phpscripts/pdoconn.php");
$id =$_SESSION["id"];
if(!empty($_POST["procjname"]) && !empty($_POST["procjtype"]) && !empty($_POST["course"])){
$ProjectName = $_POST["procjname"];
$ProjectType = $_POST["procjtype"];
$ProjectCourse = $_POST["course"];
try{
	//Query database to save a new project
$stmt = $conn ->prepare("INSERT INTO project(ProjectName, CreatedBy , ProjectType, ProjectCourse) VALUES (:ProjectName, :CreatedBy, :ProjectType, :ProjectCourse)");
$result = $stmt -> execute(["ProjectName"=>$ProjectName, "CreatedBy"=>$id, "ProjectType"=>$ProjectType, "ProjectCourse"=>$ProjectCourse]);;
if($result){
	//Query database to retrieve project id
	$procid;
	$sql = "SELECT ProjectId, ProjectName FROM project Where ProjectName = '$ProjectName'";
	$query = $conn -> query($sql);
	$procjname;
	$row=$query->fetch();
		$procid = $row->ProjectId;
		$procjname = $row->ProjectName;


		//Add the user to the member table
		$adduser = $conn ->prepare("INSERT INTO members(userId, project_id, project_name) VALUES(:userid, :project_id, :project_name)");
		$query = $adduser->execute(["userid"=>$id, "project_id"=>$procid, "project_name"=>$ProjectName]);
	// Build a http url and store in database
	$values  = array('id' =>$procid , 'name' =>$procjname);
	$fileurl ="project.php?".http_build_query($values);
	$insertquery = "UPDATE project SET projectUrl= '$fileurl' Where ProjectName ='$ProjectName'";
	$query = $conn ->query($insertquery);
	echo $fileurl;
}else{
	echo "error on query";
}

}catch(PDOException $e){
	echo $e->getMessage();
}
}else{
	echo 0;
}
?>