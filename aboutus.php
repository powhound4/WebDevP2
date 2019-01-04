<?php
include('config.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	<!-- Add appropriate required meta tags needed for the responsive webpage using bootstrap -->
	
	<!-- Add required bootstrap CDN links for style sheet and required scripts -->
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch , Alison Finnman" />
		<meta name="keywords" content= "CT310, About Us, IFY" />
		<meta name="description" content="About Us" />

		<?php include('inc.head.php');?>
		<title>MTN EATZ - About Us</title>

	</head>


	<body>

	<!-- Use the jumbotron for creating the header for the webpage -->

		<?php include('inc.header.php');?>
	
	<!-- Create the collapsing navigation bar -->
		
		<?php include('inc.navbar.php');?>
		
	<!-- first col-->
		
		<div class="container-fluid">
		<br></br>
			<div class="row">
                <h1><center><strong>About Us</strong></center></h1>

	<!-- ingredient -->
            <div class="col-xs-6">
	

	<div class="aboutUs">
            <center><strong><h2>George Hatch</h2></strong></center>
                    <p id="G">George enjoys spending his freetime outside exploring nature and all it has to offer. When it comes to cooking he enjoys getting creative in the kitchen. Using only the freshest ingredients he enjoys experimenting, and creating amazing food in the process.  However making 3 great meals everyday can be exhausting, so when he does cook, he makes multiple servings that will last a few days; eliminating the TV dinner! </p>
                </div>
               </div>   
    <div class="col-xs-6" >
    <div class="aboutUs">
	  <center><strong><h2>Alison Finnman</h2></strong></center>
                    <p id="J"> Alison is a junior studying applied computing technology. In her free time she enjoys attending concerts at Colorado's most beautiful venues and fishing during the summers. She prefers not to cook, but when she does, she is sure to use fresh, local ingredients that add color and zest to her meals!</p>
                </div>
   
	<!-- thrid col -->				
			

			</div>
		</div>
		
        <?php include('inc.footer.php');?>
	</body>
</html>
