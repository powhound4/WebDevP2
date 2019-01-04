<?php
include('config.php');

session_start();
include('database.php');
include('inc.functions.php');
 $db = new Database();
 $ingredients = $db->getIngredients();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	<!-- Add appropriate required meta tags needed for the responsive webpage using bootstrap -->
	
	<!-- Add required bootstrap CDN links for style sheet and required scripts -->
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, Alison Finnman" />
		<meta name="keywords" content= "CT310, Front Page, IFY" />
		<meta name="description" content="Front Page" />
        <?php include('inc.head.php');?>
		


		<title>MTN EATZ</title>

	</head>


	<body>

	<!-- Use the jumbotron for creating the header for the webpage -->

		<?php include('inc.header.php');?>
	
	<!-- Create the collapsing navigation bar -->
		
		
            <?php include('inc.navbar.php');?>
		
		<div class="container-fluid">
        
            <div class="row1">
                <h1>Welcome</h1>
                <p>Choose from our six ingredients to help you spice up your life!</p>
            </div>
		
            
                <div class="row">
               
                    <?php foreach($ingredients as $ing) { ?>
                         <!--<div class="row2">-->
                                <div class="col-xs-12">
                                    <h3><center><strong><?php echo $ing["NAME"]?></strong></center></h3>
                                    <center><a href="./ingredients.php?page=<?php echo $ing["NAME"]?>"><img src="<?php echo $ing["IMG"]?>" class="img-rec" alt="ing1" width=10% height=10%></a></center>
                                    <p><center><?php echo $ing["DESC"]?></center></p>
                                </div>
                        <!--</div>-->
                    <?php  } ?>
                </div>
            
              
			
		</div>
		
        <?php include('inc.footer.php');?>
	</body>
</html>
