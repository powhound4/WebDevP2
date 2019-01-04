<?php
include('config.php');
session_start();
include('inc.functions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, Alison Finnman">
		<meta name="description" content="Forgot My Password">
		<meta name="keywords" content="Forgot my password">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include('inc.head.php');?>
		<title>Forgot My Password</title>

	</head>


	<body>

	<!-- Use the jumbotron for creating the header for the webpage -->

    <?php include('inc.header.php');?>
		
	<?php include('inc.navbar.php');?>

		
	
		
		<div class="container-fluid">
		
			<div class="row">
                <div class="col-xs-4 col-md-3 col-lg-3">
                  

                   


                </div>
       
	<!-- Add Main Content here -->
	<div class="col-xs-8 col-md-6 col-lg-6">
	<?php if(isset($_POST['send'])){
        $selected = $_POST['username'];
        $users = readUsers();
        $admin = readAdmin();
        for($i=0; $i < count($users); $i++){
			 if($users[$i]->username == $selected){
                $url = "http://www.cs.colostate.edu/~powhound/project2/passwordreset.php?key=";
                $email = $users[$i]->email;
                //echo $email;
                $newPass = str_shuffle('cacheLaPoudre');
                $newPass = password_hash($newPass, PASSWORD_BCRYPT);
                $link = $url . $newPass;
                mail($email, "New password", $link);
                $_SESSION['key'] = $newPass;
                $_SESSION['username'] = $selected;
                $_SESSION['admin'] = "False";
			 }
            }
        for($i=0; $i < count($admin); $i++){
			 if($admin[$i]->username == $selected){
                $url = "http://www.cs.colostate.edu/~powhound/project2/passwordreset.php?key=";
                $email = $admin[$i]->email;
                //echo $email;
                $newPass = str_shuffle('cacheLaPoudre');
                $newPass = password_hash($newPass, PASSWORD_BCRYPT);
                $link = $url . $newPass;
                mail($email, "New password", $link);
                $_SESSION['key'] = $newPass;
                $_SESSION['username'] = $selected;
                $_SESSION['admin'] = "True";
			 }
        }
    }
	?>
	
	
	
	<h2><center>Select Your Username</center></h2><br></br>
	<center><form action="#" method="post">
			<select name="username">	
			<?php 
			$users = readUsers();
			 for($i=0; $i < count($users); $i++){
			 $temp = $users[$i]->username;
			 
			 ?>
                 <option value="<?php echo $temp;?>" > <?php echo $temp;?></option>
        <?php }
			?>
			<?php 
			$admin = readAdmin();
			 for($i=0; $i < count($admin); $i++){
			 $temp = $admin[$i]->username;
			 
			 ?>
                 <option value="<?php echo $temp;?>" > <?php echo $temp;?></option>
        <?php }
			?>
			</select> 
			
			<input type= "submit" value="Send E-mail" />
			<input type="hidden" value="done" name="send">
		</form></center>

        
               
    


    </div>

	<!-- Add Image here -->				
			<div class="hidden-xs hidden-sm col-md-3 col-lg-3">
			
                
            </div>
			
			
			
			
			
			</div>
		</div>
		
        <div class="footer">
        <p><center>&copy; Copyright 2017 George Hatch</center></p></div>
	</body>
</html>
