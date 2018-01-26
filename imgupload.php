<?php 
session_start();
require("phpscripts/pdoconn.php");
define ("FILEREPOSITORY","passports/");
if(isset($_FILES['photopass']['name'])){
	if(is_uploaded_file($_FILES["photopass"]["tmp_name"])){
		if($_FILES["photopass"]["type"] =="image/jpg" || $_FILES["photopass"]["type"] =="image/jpeg" || $_FILES["photopass"]["type"] =="image/png"){
			$email = $_SESSION['name'];
			$filename = $_FILES["photopass"]['name'];
			$filetype = $_FILES['photopass']["type"];
			$fileloc = $_FILES['photopass']['tmp_name'];
			$result = move_uploaded_file($_FILES['photopass']['tmp_name'], FILEREPOSITORY.$filename);
			rename('passports/'.$filename, 'passports/'.str_replace(".PNG", (string)time(), $filename));
			$filename =str_replace(".PNG", (string)time(), $filename);
			try{
			$query = "SELECT id from users WHERE email ='$email'";
			$res = $conn -> query($query);
			$res ->execute();
			$id;
			while($row =$res->fetch()){
				$id =$row ->id;
			}
			}catch(PDOException $e){
				echo $e ->getMessage();
			}
		if($result==1){
			$_SESSION["image"] = $filename;
			try{
			$sql ="UPDATE users SET passportName ='$filename' WHERE id = '$id'";
			$query = $conn->query($sql);
			if($query){
				echo "1";
			}else{
				echo "Could not insert into database";
			}

		}
		catch(PDOException $e){
				echo $e ->getMessage();
			}
						

		}else{
			echo "There was an error uploading file";
		}
		}else{
			echo "Incorrect file type";
		}
	}

}
else{
	echo "No photos";
}

?>