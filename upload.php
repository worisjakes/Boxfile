<?php 
require('phpscripts/pdoconn.php');
session_start();
$email = $_SESSION['name'];
define ("FILEREPOSITORY","uploads/");
	if(isset($_POST['btn'])){
		if(isset($_FILES['myFile']['name'])){
			if(is_uploaded_file($_FILES['myFile']['tmp_name'])){
				if($_FILES['myFile']['type'] != "application/pdf"){
			echo "<div class='container'>
					<p> Error : Files must be uploaded in pdf format</p>
				<button class='btn'>Go back</button>";
		}else{
			$name = $_POST['name'];
			$course = $_POST['course'];
			$description = $_POST['description'];
			$level = $_POST['level'];
			$filetype =$_POST['filetype'];
			$filename = $_FILES['myFile']['name'];
			$filesize = $_FILES['myFile']['size'];
			$filetype = $_POST['filetype'];
			$fileloc = $_FILES['myFile']['tmp_name'];
			rename('uploads/'.$filename, 'uploads/'.str_replace(".pdf", (string)time(), $filename));
			$result = move_uploaded_file($_FILES['myFile']['tmp_name'], FILEREPOSITORY.md5($filename));
			try{
			$query = "SELECT id from users WHERE email ='$email'";
			$res = $conn -> query($query);
			$res ->execute();
			$id;
			while($row =$res->fetch()){
				$id =$row ->id;
				echo $id;
				$field = array(
					"id"=>(string)$id,
					"filename"=>md5($filename)
					);
				$file_url = "http://boxfile.com/photocopy.php?". htmlspecialchars(http_build_query($field));
			}
		}catch(PDOException $e){
			echo $e ->getMessage();
		}
			if($result==1){
				$sql = "INSERT INTO files(user_id,fileName, fileSize, relatedCourse, relatedLevel, fileDescription,file_type,file_url) VALUES('$id','$name','$filesize', '$course','$level','$description','$filetype','$file_url')";
				$result= $conn->query($sql);
				if($result){
				}
				header("Location:myfiles.php");
			}else{
				echo "<p> There was an error uploading  file</p>";
			}
		}
	}
}
}

?>

