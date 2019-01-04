<?php
include('config.php');

session_start();

 include('database.php');
 include('inc.functions.php');
 $db = new Database();
 $page = $_GET['page'];
 $ing = "\"$page\"";
 $ingredient = $db->getIngredient($ing);
// $description = $db->getDescription($ing);
 //$image = $db->getImage($ing);
 //$image = $db->getImg($ingredient['IMG']);
 
 if(isset($_POST['add'])){
    if(!isset($_SESSION['cart_products'])){
        $_SESSION["cart_products"] = array();
        $_SESSION['prodNum']=0;
        $_SESSION['cart_products'][$_SESSION['prodNum']]['productName']= $page;

    }
   
    else{
     $_SESSION['prodNum']+=1;
        $_SESSION['cart_products'][$_SESSION['prodNum']]['productName']= $page;
        }
        
   $num = $_SESSION['prodNum'];
    if(isset($_POST['quantity'])){
        if(!isset( $_SESSION['cart_products'][$num]['quantity'])){
         $_SESSION['cart_products'][$num]['quantity'] = $_POST['quantity'];
        }
        else{
        $_SESSION['cart_products'][$num]['quantity'] += $_POST['quantity'];
        }
            $f = floatval(substr($ingredient['PRICE'],1));

        $_SESSION['cart_products'][$num]['price'] = $f;
            
    }
    else{
    echo "*** Must enter the Quantity before these can be added to your cart. ***";
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	<!-- Add appropriate required meta tags needed for the responsive webpage using bootstrap -->
	
	<!-- Add required bootstrap CDN links for style sheet and required scripts -->
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, " />
		<meta name="keywords" content= "CT310, <?php echo $page?>, IFY" />
		<meta name="description" content="<?php echo $page?>" />

		<?php include('inc.head.php');?>
		<title>MTN EATZ - <?php echo $page?> </title>
		

	</head>


	<body>

	<!-- Use the jumbotron for creating the header for the webpage -->

		<?php include('inc.header.php');?>
	
	<!-- Create the collapsing navigation bar -->
		
		<?php include('inc.navbar.php');?>
		
	<!-- first col-->
		
		<div class="container-fluid">
<div class="row1">
            <h1> <?php echo $page ?> </h1>
            <?php echo $ingredient['DESC']; ?>
		</div>			
		<div class="row">
                

	<!-- ingredient -->
	<div class="col-xs-6">
	  <center><img src="<?php echo $ingredient['IMG'];?>" class="img-square" alt="ing" width=40% height=40%></img></center>
    <?php if(isset($_POST['quantity'])){
    //echo $price;
    } ?>
        <center><?php echo $page . " are " . $ingredient['PRICE'];?><form method="POST" action="#">
        <input type="number" placeholder="Quantity" name="quantity" required>
        <input type="hidden" value="done" name="add">
        <input type="submit" value="Add to Cart">
        </form></center>
                
                <?php include('inc.comment.php');?>
                
                </div>

			</div>
		</div>
		
        <?php include('inc.footer.php');?>
	</body>
</html>
