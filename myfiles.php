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
	#interested, #Myfiles{
		margin-top: 50px;
		border:1px solid black;
	}
</style>
<body>
	<header class="" id ="clearfix">
	<img  class="circle" width ="50px;" src ="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAPNKybKrpJIws2B7XkM7L-KZSuXI22siIRHtZ0fJXurbRUBbb"/>
	<h4 class="center-align">BOXFILE</h4> <hr/>
	</header>
	<div class="grey lighten-2 container">
		<h5 class="thin left-align">My passport</h5>
		<section>
			<div class=" black divider"></div>
		</section>
		<div class="row">
			<div class="col offset-l4 offset-s4">
				<img style="border:1px solid black; border-radius: 50%" width="50%" class="responsive-img" src ="image/jakes.jpg"/>
			</div>
			<div class="row">
			<div class="col s12 offset-l4 offset-m4">
			<a class="btn blue " href="updatepassport.php">Change Passport</a>
			</div>
			</div>
		</div>
		</div>
		<section id="interested">
			<p><h6> Files you may be intrested in</h6></p>
			<div class="row">
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
			</div>
			<a class="btn blue" href="filestore.php">Go to file store</a>
		</section>
		<section id ="Myfiles">
			<p><h6>My files</h6></p>
			<div class="row">
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
				<div class="col s12 m3 l3">
					files goes here
				</div>
			</div>
			<div class="row">
				<div class ="col m6 s12 l6">
					<a class="btn blue" href="filestore.php">PREVIOUS</a>	
				</div> 
				<div class ="col m6 s12 l6">
					<a class="blue btn" href="filestore.php">NEXT</a>	
				</div>
			</div>
		</section>
		<section id ="Myfiles">
			<p><h6><strong>My projects</strong></h6></p>
			<p class="center-align">You have no imported projects</p>
		</section>
         	<div class="fixed-action-btn  horizontal">
			    <a class="btn-floating pulse btn-large red">
			      <i class="large material-icons">mode_edit</i>
				</a>
			    <ul>
			      <li><a class="btn-floating red"><i class="material-icons">group_add</i></a></li>
			      <li><a class="btn-floating yellow darken-1"><i class="material-icons">add_a_photo</i></a></li>
			      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
			      <li><a class="btn-floating blue"><i class="material-icons">store</i></a></li>
			    </ul>
  			</div>
    	</foot
</body>
</html>