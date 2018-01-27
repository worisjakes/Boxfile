<?php 
require("phpscripts/header.php"); 
$pdf = $_GET['q'];
?>
<script>
$(document).ready(()=>{
	$("#printbtn").click(e=>{
		e.preventDefault();
	var addr = $("#myadd").val();
	var pageno = $("#pageno").val();
	var copies= $("#copies").val();
	var filename = $("#hidden").val();
	var attachpass = $("input[name='radio']").val();
	if(addr == "" || pageno == "" || copies== "" || attachpass ==""){

	}else{
		$.ajax({
			url:"print.php",
			type:"POST",
			data : {address:addr, pageno:pageno,copies:copies, attachpass:attachpass, filename:filename},
			success:(data,success)=>{
					if(data = "success"){
						window.location.assign("myfiles.php");
						alert("Your request has been successfully submitted");
					}
			}
		})
	}
	})
})
</script>
<div class="container">
<div style="margin:1px solid black">
<object  width="500px" height="650px;" data =uploads/<?php echo $pdf; ?> type="application/pdf">
</object>
</div>
<form class = "form">
<legend class= "center-align">Make Photocopy</legend>
<div class="input-field">
<input type="text" required id ="myadd"/>
<label for="myadd">Address to deliver pdf print out</label>
</div>
<div class="input-field">
<input required type="number" id ="pageno"/>
<label for="pageno">Total number of pdf pages</label>
</div>
<div class="input-field">
<input required type="number" id ="copies"/>
<label for="myadd">Number of copies required</label>
</div>
<p>
<input class="with-gap" type ="radio" name ="radio" id="radio1" value="True"/>
<label for = "radio1">Yes</label>
</p>
<p>
<input class="with-gap" type ="radio" name ="radio" id="radio2" value="False"/>
<label for = "radio2">No</label>
</p>
<input type="hidden" id="hidden" value= <?php echo $pdf; ?>>
<div class="row">
<div class="col offset-s4 offset-l5 offset-m5">
<button id="printbtn" class="btn blue" type ="submit">Submit </button>
</div>
</form>
</div>
<hr>