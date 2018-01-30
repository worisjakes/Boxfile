<?php 
session_start();
$name = $_SESSION['name'];
require("phpscripts/header.php");
require("phpscripts/nav.php");
require("phpscripts/pdoconn.php");
?>
<style>
.display{
	display:none;
}
#proclist{
	margin: 100px auto;
}

</style>
<script type="text/javascript">
	$(document).ready(() =>{
		$(".show").click((e)=>{
			$("#btn").addClass("display");
			$("#stage1").show().slideDown("slow");
		})
		$(".add").on("click", (e)=>{
			e.preventDefault();
			var procjname = $("#procjname").val();
			var procjtype = $("input[name=radio]:checked").val();
			var course = $("#level").val();
			$.ajax({
				url :"addproject.php",
				type:"POST",
				//responseType:"json",
				data: {procjname:procjname, procjtype:procjtype, course:course},
				success: (data, status)=>{
					if(data !="0"){
							//var mydata = JSON.parse(data);
							location.assign(data);
					}else{
						alert(data);
					}
				}
			})

		});
	})
</script>
<div class="container">
<div class="card blue">
<p><h4 class="center-align thin"> Welcome Please click on the add icon to create a new project</h4></p>
<div class="row">
	<div id="btn" class="col s12 offset-s4 offset-l5 offset-m5">
		<button class="show  btn pink pulse btn-floating"><i class=" material-icons">add</i></button>
	</div>
</div>
	<form style="display: none" id ="stage1"> 
		<div class="input-field">
			<input type ="text" id="procjname" required/>
			<label class="white-text" for="procjname"> Project Name</label>
		</div>
		<p>
			<input required class="with-gap" type ="radio" name ="radio" id="radio1" value="Group"/>
			<label class="white-text" for = "radio1">Group</label>
		</p>
		<p>
			<input required class="with-gap" type ="radio" name ="radio" id="radio2" value="Private"/>
			<label class="white-text" for = "radio2">Private</label>
		</p>
		<select name ='level' required id="level">
	      <option value=""  disabled selected>Choose Project related course</option>
	      <option value="AGE">AGE</option>
	      <option value="FST">FST</option>
	      <option value="CVE">CVE</option>
	        <option value="MEE">MEE</option>
	        <option value="CSC">CSC</option>
					    </select>
		<div class="row">
		<div class="col offset-s4 offset-m5 offset-l5">
		<button class=" add btn pink">Add</button>
		</div>
		</div>
	</form>
</div>
<div id="proclist" class="card">
<p class="center-align"><h5 class="thin center-align">These are the projects you are currently active on</h5></p>
<?php
$projquery = $conn->prepare("SELECT ProjectName, projectUrl from project INNER JOIN members where members.userId=:memid");
$projquery->execute(["memid"=>$_SESSION["id"]]);
$projrow= $projquery->fetchAll();
if($projquery->rowcount()>0){
foreach ($projrow as $row) {
	echo '<ul><li><a href="'.$row->projectUrl.'">'.$row->ProjectName.'</a></li></ul>';
}
}else{
	echo '<p><h4 class="thin center-align"> You currently have no projects </h4></p>';
}
?>

</div>
</div> 