<?php
include('config.php');
session_start();
if(isset($_POST['orderDelete'])){
unset($_SESSION['cart_products']);
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	<!-- Add appropriate required meta tags needed for the responsive webpage using bootstrap -->
	
	<!-- Add required bootstrap CDN links for style sheet and required scripts -->
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, Alison Finnman " />
		<meta name="keywords" content= "CT310, Front Page, IFY" />
		<meta name="description" content="Front Page" />
		<link rel="stylesheet" href="project2.css">
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
            <h1>Shopping Cart</h1>
<!--             <p>Choose from our three ingredients to help you spice up your life!</p> -->
		</div>
		
			<div class="row">
			
	<!-- first ingredient-->
                <div class="col-xs-2">
                    
                </div>

	<!--second ingredient -->
                <div class="col-xs-8">
                    <h3><center><strong>Your Cart</strong></center></h3>
						
        <?php
        
        if(isset($_POST['quantity'])){
       // echo $_POST['quantity'];
        //echo $_POST['productName'];
         $productName = $_POST['productName'];
         $quantity = $_POST['quantity'];
         $array = $_SESSION['cart_products'];
       for($i = 0; $i < count($_SESSION['cart_products']); $i++){
       //foreach($array as $items){
                //echo $_SESSION['cart_products'][$i]['productName'];
             if($_SESSION['cart_products'][$i]['productName'] == $productName){
                 $_SESSION['cart_products'][$i]['quantity'] = $quantity;
                 }
                }
            
        //print_r($_SESSION['cart_products']);
        }
                
    ?>
						
						<?php
						if(isset($_SESSION['cart_products'])){
                            //print_r($_SESSION['cart_products']);
							$_SESSION['total'] = 0;
							echo "<table >";
							echo "<tr>";
								echo"<th>Product Name</th>";
								echo"<th>Price</th>";
								echo"<th>Quantity</th>";
								echo"<th>New Quantity</th>";
								echo"</tr>";
                            $array = $_SESSION['cart_products'];
                            $i =0;
							foreach($array as $items){
								$productName = $items['productName'];
								$price = str_pad( $items['price'], 4, "0", STR_PAD_RIGHT );
								$quantity = $items['quantity'];
								
							echo "<tr>"	;
								echo "<td>";
								echo $productName;
								echo "</td>";
								echo "<td>";
								echo '$'.$price;
								echo "</td>";
								echo "<td>";
								echo $quantity;
								echo "</td>";
								echo "<td>";
								 echo "<form method = 'post' action= './cart.php'>
								<input type='number' min='1' max='100' name='quantity' style='background-color:#bfdf60; border: 2px solid black; border-radius: 4px; text-align:left; outline:none;width:100%; padding:1% ;'>
								<button class= 'button' type='submit'  name= 'productName' value= '$productName'>Update Cart</button>
								</form>";
								 echo "</td>";
							echo "</tr>";
							$_SESSION['total'] = $_SESSION['total'] + ($price * $quantity);
							
							}
						$total = str_pad($_SESSION['total'], 4, "0", STR_PAD_RIGHT );
						echo "<h3 style= 'text-align: center'> Cart Total: $$total </h3>";
						?>
				<form action = "./orderSubmit.php" method="post">
				<button name = "orderSubmit" class= "button" type= "submit">Submit Order </button> </form>
                
                <form action = "#" method="post">
				<button name = "orderDelete" class= "button" type="submit" align="right">Delete Order</button>
				</form>
				<?php
						}
							else{
								echo "<center>No Items In Cart</center>";
							}
						?>
							
				</table> 
				<?php 
				
				 ?> 

                </div>

	<!-- thrid ingredient -->				
                <div class="col-xs-2">
                </div>
			</div>
		</div>
		
        <?php include('inc.footer.php');?>
	</body>
</html>
