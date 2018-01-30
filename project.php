<?php
session_start();
require("phpscripts/header.php");
require("phpscripts/nav.php");
require("phpscripts/pdoconn.php");
$name =$_GET["name"];
$stmt = $conn -> prepare("SELECT * FROM project INNER JOIN users WHERE ProjectId = :id AND users.id = CreatedBy");
$stmt->execute(["id"=>$_GET['id']]);
$rowsresult = $stmt->fetch();
$sql = "SELECT * from users INNER JOIN members WHERE id =userId AND project_id =".$_GET['id'];
$sql = $conn-> query($sql);
$sql->execute();
$result = $sql->fetchAll();
?>
<script type="text/javascript">
	$(document).ready(()=>{
		$(".button-collapse").sideNav();
		$("#showform").click((e)=>{
			$("#foremail").show();
		});
		$("#addmember").click(e=>{
			e.preventDefault();
			var email= $("#mail").val();
			var hidden1 = $("#hidden1").val();
			var hidden2 = $("#hidden2").val();
			alert(hidden1);
			if(email == ""){
				alert("No email");
			}else{
				$.ajax({
					url:"addmember.php",
					type:"POST",
					data:{email:email, hidden1:hidden1, hidden2:hidden2},
					success: (data, sucess)=>{
						if(data=="1"){
						$("#status").html("User "+email+" Successfully added");
					}else{
						$("#status").html(data);
					}
					}
				});
			}
		})
	});
</script>
<style type="text/css">
.projecttitle{
	border:1px solid black;
}
#comments{
	margin-top: 50px;
}
#foremail{
	display: none;
}
</style>
<div class=".projecttitle">
<p><h6 class="thin">Project title: <strong ><?php echo $_GET['name'];?></strong></h6></p>
<p><h6 class="thin">Created On: <strong><?php echo $rowsresult->CreatedAt?></strong></h6></p>
<p><h6 class="thin">Created By: <strong><?php echo $rowsresult->name ?></strong></h6></p>
<p><h6 class="thin">Project link: <strong><?php echo $_GET['name'];?></strong></h6></p>
<ul id="slide-out" class="side-nav">
<p> Here are projects you are currently <span class="blue-text">Active</span> In</p>
<?php
$projquery = $conn->prepare("SELECT ProjectName, projectUrl from project INNER JOIN members where members.userId=:memid");
$projquery->execute(["memid"=>$_SESSION["id"]]);
$projrow= $projquery->fetchAll();
foreach ($projrow as $row) {
	echo '<li><a href="'.$row->projectUrl.'">'.$row->ProjectName.'</a></li>';
}
?>
</ul>
 <a href="#" data-activates="slide-out" class="button-collapse btn-floating pink pulse"><i class="material-icons">group</i></a>
</div>
<div class="container">
<div class="card">
<p ><h5 class="center-align">Group Members</h5></p>
<p id="status" class="center-align"></p>
<div id="users">
<?php
foreach ($result as $row) {
	echo'<div class="chip">
	<div class="row">
	<div class="col s4 l4 m4">'
	.$row ->name.

	'</div>
	<div class="col s4 l4 m4">
	<button  class="btn-flat red-text  btn">Remove</button>
	</div>
	</div>
	</div>';
}
 ?>
</div>
<div id="foremail" class="container">
<div class="input-field">
<form>
<div class="row">
<div class="col s4 l6 m6">
<input type="hidden" value=<?php echo $_GET["id"];?> id ="hidden1"/>
<input type="hidden" value="<?php echo $_GET['name'];?>";" id ="hidden2"/>
<input placeholder="Enter users email to add them or send invite if not registered" id ="mail" type="email"/>
<label for ="email">Add a member</label>
</div>
<div class="col s4 l2 m2">
<button id="addmember" class="btn pink">Add member</button>
</div>
</div>
</form>
</div>
</div>
<div class="row">
<div class="col s4 offset-l5 offset-m5">
<button id ="showform" class="btn pink btn-floating"><i class="material-icons">add</i></button>
</div>
</div>
</div>
		<div class="card">
			<p ><h5 class="center-align">Recent Acitivities</h5></p>
			<?php
				echo "<ul>
					<li>Project ". $rowsresult->ProjectName." was created by ".$rowsresult->name ." On ".$rowsresult->CreatedAt ."</li>
				</ul>";
				foreach ($result as $row) {
					echo "<ul>
							<li>".$row->name." Edited project with comments ".$row->editComment." On ".$row->postedDate."
							</ul>";
				}
			?>
		</div>
<div class="card">
<p ><h5 style="text-decoration: underline;"  class="center-align"><?php echo $_GET['name']; ?></h5></p>
<div id ="text">
<?php
$smt = $conn->prepare("SELECT Posts FROM project Where ProjectId=:id ");
$smt->execute(["id"=>$_GET["id"]]);
$results = $smt->fetch();
	echo $results->Posts;
?>
</div>
</div>
<form id ="sumitform"  action="addpost.php" method ="POST">
<textarea id="editor1"  name="editor1"><?php echo $results->Posts?></textarea>
<textarea required name="comments" placeholder="Please enter comment pertaining to your change so others know what you might have added" id="comments"></textarea>
<input type="hidden" name="hidden" value=<?php echo $_GET["id"];?> id ="hidden"/>
<div class="row">
<div class="col l6 m6 s6">
<button name="submit" type="submit" id ="save" class="btn btn-large pink"> Save</button>
</div>
<div class="col l6 m6 s6">
<button class="btn btn-large pink"> Save to UDisk!!</button>
</div>
</div>
</form>
<script>
			CKEDITOR.replace( 'editor1' );
</script>
</div>
</body>