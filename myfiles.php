<!DOCTYPE html>
<html>
<head>
	<title>BOXFILE | HOME</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src ="scripts/main.js"></script>
	<meta name ="viewport" content = "width= device-width, initial-scale = 1.0">
	<link rel = "stylesheet", href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons", rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<style type="text/css">
	*{
		margin: 0px;
		padding: 0px;
	}
	/*ul#files{
		flex: 1;

	}*/
	header{
		/*border: 1px solid black;*/
	}
	header img{
		float: right;
		border: 1px solid black;
		margin-top: 5px;
	}
	.clearfix:after{
		clear: both;
	}
	.container{
		margin-top: 50px;

	}
	#interested{
		margin-top: 50px;
	}
	#Myfiles{
		margin-top: 50px;
	}
</style>
<script>
	$(document).ready(()=>{
	$("#passportbtn").click(e =>{
			e.preventDefault();
			var upload_btn = document.getElementById('passportbtn');
			var passportfile = document.getElementById('passportfile');
			var files = passportfile.files[0];
			upload_btn.innerHTML ="Uploading";
			var formdata = new FormData();
			formdata.append("photopass", files, files.name);
			if (!files.type.startsWith('image/')){
				alert("Incorrect file type");
			}else{
			$.ajax(
			{
				url:"imgupload.php",
				method:"POST",
				data:formdata,
				async:false,
				processData:false,
				success: (data, success)=>{
					if(data = "1"){
						window.location.reload();
					}
				},
				cache:false,
				contentType:false
			})
		}
	});;
		$('select').material_select();
		$('#fileSelect').click((e)=>{
			$(".container.form").show("slow");
		});
	});
</script>
<body>
<?php session_start();
	require("phpscripts/header.php");
	require("phpscripts/Nav.php");
?>
	<div class="grey lighten-2 container">
	<?php
	$name = $_SESSION['name'];
	require("phpscripts/pdoconn.php");
	if(!isset($_SESSION['name'])){
		header("Location:index.html");
}
	$query ="SELECT * FROM users WHERE email  ='$name'";
	$level ="";
	$passport;
	$query = $conn->query($query);
	$query -> execute();
	$id="";
	while($row = $query->fetch()){
		$id = $row->id;
		$level = $row->level;
		$passport = $row ->passportName;
	}
	$_SESSION['id'] =$id;
	?>
		<h5 class="thin left-align">My passport</h5>
		<section>
			<div class=" black divider"></div>
		</section>
		<div class="row">
			<div class="col offset-l4 offset-s4">
				<img style="border:1px solid black; border-radius: 50%" width="50%" class="responsive-img" src =passports/<?php echo $passport?> />
			</div>
			<div class="row">
			<div class="col s12 offset-l4 offset-m4">
			<form enctype="multipart/form-data" id ="#imgform">
			<input accepts ="image/*" type = "file" name="photopass" id="passportfile"/> 
			<button id="passportbtn" type="submit" class="btn blue ">Change Passport Photo</button>
			</form>
			</div>
			</div>
		</div>
		</div>
		<section id="interested">
			<p><h5><strong> Files you may be intrested in</strong></h5></p>
			<div class="row">
			<?php
				$query = "SELECT * FROM files WHERE relatedLevel = '$level'";
				$result = $conn -> query($query);
				$result -> execute();
				$row = $result->fetchAll();
				foreach ($row as $k) {
				echo '	
				<div class="col s12 m3 l3">
					<div class="row">
						<div class="col s12 m4 l4 ">
							<img class="responsive-img"  src="https://i.gadgets360cdn.com/large/How_to_Edit_PDF_Files_on_Word_Android_Web_iPhone_Desktop_1486559066639.jpg?output-quality=80"/>
							</div>
						<div class="col s12 m8 l8 ">
						<ul>
							<li>'.$k->name.'</li>
							<li>'.$k->relatedLevel.'</li>
							<li>'.$k->relatedCourse.'</li>
						</ul>
						</div>
						<p> Decscription: This file is just a file that tell us about chemistry and biology</p>
					</div>
					<div class="row">
						<div class="col s4 m4 l4">
							<a href ="preview.php?q='.$k->fileName.'" class="btn red"><i class="material-icons">print</i></a>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn yellow"><i class="material-icons">file_download</i></button>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn blue"><i class="material-icons">share</i></button>
						</div>
					</div>
				</div>';}?>
				</div>
			<div class="row">
				<div class ="col m4 offset-s5 offset-l5"> 
					<button class=" pink btn">GO TO FILE STORE</button>
					</div>	
			 </div>
		</section>
		<section id ="Myfiles">
		<p><h5 class="thin"><strong>My files</strong></h5></p>
		<div class="row">
			<?php
				$query = "SELECT * FROM files WHERE user_id = '$id'";
				$result = $conn -> query($query);
				$result -> execute();
				$count = $result ->rowCount();
				if($count == 1){
					$row = $result -> fetch();
					echo'
							<div class="col s12 m3 l3">
							<div class="row">
						<div class="col s12 m4 l4 ">
							<img class="responsive-img"  src="https://i.gadgets360cdn.com/large/How_to_Edit_PDF_Files_on_Word_Android_Web_iPhone_Desktop_1486559066639.jpg?output-quality=80"/>
							</div>
							<div class="col s12 m4 l4 ">
								<ul>
									<li>'. $row ->name  .'</li>
									<li>'. $row ->relatedLevel.'</li>
									<li>'.$row ->relatedCourse.'</li>
								</ul>
							</div>
							</div>
							<div class="row">
						<div class="col s4 m4 l4">
							<a href ="preview.php?q='.$k->fileName.'"" class="btn blue"><i class="material-icons">print</i></a>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn blue"><i class="material-icons">file_download</i></button>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn blue"><i class="material-icons">share</i></button>
						</div>
					</div>				
				</div>';

				}else if($count == 0){
					echo '<p ><h5 class="center-align">You have not yet uploaded any files, Click on cloud upload to upload and save your university documents</h5></p>';
				}

				else{
					$rows = $result -> fetchAll();
				foreach ( $rows as $k) {
						 ?>
							<?php echo'
							<div class="col s12 m3 l3">
							<div class="row">
						<div class="col s12 m4 l4 ">
							<img class="responsive-img"  src="https://i.gadgets360cdn.com/large/How_to_Edit_PDF_Files_on_Word_Android_Web_iPhone_Desktop_1486559066639.jpg?output-quality=80"/>
							</div>
							<div class="col s12 m8 l8 ">
								<ul>
									<li>'. $k ->name  .'</li>
									<li>'. $k ->relatedLevel.'</li>
									<li>'.$k ->relatedCourse.'</li>
								</ul>
							</div>
							<p> File description goes here</p>
							</div>
							<div class="row">
						<div class="col s4 m4 l4">
							<a href = "preview.php?q='.$k->fileName.'"" class="btn red"><i class="material-icons">print</i></a>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn yellow"><i class="material-icons">file_download</i></button>
						</div>
						<div class="col s4 m4 l4">
							<button class="btn blue"><i class="material-icons">share</i></button>
						</div>
					</div>
					</div>';
					}
					}
					?>
			 </div>
			 <div class="row">
				<div class ="col m4 offset-s5 offset-l5"> 
					<button id ="fileSelect" class="pink btn">Upload file<i class="material-icons">cloud_upload</i></button>
					</div>	
			 </div>
				<div style="display:none"  class="container form ">
						<form method="post" action= 'upload.php' enctype="multipart/form-data">
							<div class="input-field">
								<input required type = "text" id ="name" name="name" placeholder="" />
								<label for ="name">File name</label>
							</div>
							<div class="input-field">
								<input required type ="text" name= "course" id ="course" placeholder="Please tell us the course file is related to" />
								<label for ="course">File course</label>
							</div>
							<div class="input-field">
								<i class="material-icons prefix">mode_edit</i>
								<textarea class="materialize-textarea" name="description" type ="textarea" id ="textarea" placeholder="Please enter file description" required></textarea>
								<label for ="textarea">File description</label>
							</div>
						<select name ='level' required id="level">
					      <option value=""  disabled selected>Choose file related level if Handout</option>
					      <option value="100">100l</option>
					      <option value="200">200l</option>
					      <option value="300">300l</option>
					        <option value="400">400l</option>
					        <option value="500">500l</option>
					    </select>
					    <label> File level</label>
					    <p>
					      <input class="with-gap" name="filetype" type="radio" id="test1" />
					      <label for="test1">Personal</label>
					    </p>
					    <p>
					      <input class="with-gap" name="filetype" type="radio" id="test2" />
					      <label for="test2">Handout</label>
					    </p>
					    <p>
					    <input type ="file" name="myFile">
					    </p>
					    <div class="row">
					    <div class="col offset-m6 offset-l6">
					        <button id="filedescription" name="btn" type="submit" class="btn blue">Upload file</button>
					        </div>
					    </div>
						</form>
						</div>
			 </section>
		<section id ="Myprojects">
			<p><h6><strong>My projects</strong></h6></p>
			<p><h4  class="center-align">You have no imported projects</h4></p>
			<div class="row">
			<div class="col offset-l5 offset-m5 s12">
			<a href="projects.php" class="btn pink">Add project<i class="material-icons">group_add</i> </a>
			</div>
			</div>
		</section>
</body>
</html>