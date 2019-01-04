<?php
include('config.php');
include('inc.functions.php');
session_start();

if(isset($_SESSION['UserName'])){
$subject = "MTN EATZ Order Confirmation";
$message = // contents of report in $message
        "
        <html>
        
        <body>   
        <h1>MTN EATZ Order Summary</h1>
            <table name='order_summary' style='border:1px solid black';> 
                
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>    
                
                <tbody>";
                if(isset($_SESSION['cart_products'])){
                    foreach($_SESSION['cart_products'] as $item) { 
                        $message .="<tr>
                            <td>" . $item['productName'] ."</td>
                            <td>$".$item['price']."</td>
                            <td style='text-align:center';>".$item['quantity']."</td>
                        </tr>";
                     } 
                $message .= "</tbody>
            </table>
			<p>Order Total: $ ".$_SESSION['total']."</p> 
                
        </body>
        </html>"; //end of $message
						}	
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$admins = readAdmin();
foreach($admins as $admin){
    mail($admin->email, $subject, $message, $headers);
}

					mail($_SESSION['email'], $subject, $message, $headers);
					unset($_SESSION['cart_products']);
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	<!-- Add appropriate required meta tags needed for the responsive webpage using bootstrap -->
	
	<!-- Add required bootstrap CDN links for style sheet and required scripts -->
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, Alison Finnman" />
		<meta name="keywords" content= "CT310, Front Page, IFY" />
		<meta name="description" content="Order Submitted" />
        <?php include('inc.head.php');?>
		


		<title>MTN EATZ - Order Submitted</title>

	</head>


	<body>

	<!-- Use the jumbotron for creating the header for the webpage -->

		<?php include('inc.header.php');?>
	
	<!-- Create the collapsing navigation bar -->
		
		
            <?php include('inc.navbar.php');?>
		
		<div class="container-fluid">
	
		<div class="row1">
            
		</div>
		
			<div class="row">
		
                <div class="col-xs-2">
   
                    
                </div>
<?php if(isset($_SESSION["UserName"])){
?>
                <div class="col-xs-8">
                    <h3><center><strong><?php echo $_SESSION['UserName'] ?>, your order has been submitted.</strong></center></h3>
                    <p><center>A confirmation e-mail will be sent to you shortly.</center></p>
					<p><center>Thank you for shopping at MTN EATZ!</center></p>
                    
                </div>
	<?php }else{
	?>
	<div class="col-xs-8">
                    <h3><center><strong>Your are not logged in. Please log in to submit an order.</strong></center></h3>
                    
                    
                </div>
<?php } ?>
                <div class="col-xs-2">            
                </div>
			</div>
		</div>
		
        <?php include('inc.footer.php');?>
	</body>
</html>
