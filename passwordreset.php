<?php
session_start();
include('inc.functions.php');

if(!(isset($_SESSION['key']))){
 header("Location: ./login.php");
}
if(isset($_POST['reset'])){
    if($_POST['password'] == $_POST['confirm']){
        $pass = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $username = $_SESSION['username'];
        if($_SESSION['admin']=="False"){
            $users = readUsers();
                for($i=0; $i < count($users); $i++){
                    if($users[$i]->username == $username){
                        $users[$i]->hash = $password;
                    }
                }
        
        writeUser($users);
        }
        if($_SESSION['admin']=="True"){
            $admin = readAdmin();
                for($i=0; $i < count($admin); $i++){
                    if($admin[$i]->username == $username){
                        $admin[$i]->hash = $password;
                    }
                }
        
        writeAdmin($admin);
        }
        
      header("Location: ./login.php");  
    }
    
    }




?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
	
		
		<meta charset="utf-8">
		<meta name="author" content="George Hatch, Alison Finnman">
		<meta name="description" content="reset password">
		<meta name="keywords" content="Authentication, CT310">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include('inc.head.php');?>
		<title>Reset Password</title>

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
	
	<h2><center>Reset Password</center></h2><br></br>
	<?php
        
    if(isset($_POST['reset'])){
        if($_POST['password'] != $_POST['confirm']){
        echo '<center>***The passwords you entered do not match***</center>';
        }
        
    }
        
        
       ?>
               <center><form method="POST" action="#">
                    <input type="password" placeholder="Enter New Password" name="password" required><br></br>
                    <input type="password" placeholder="Confirm Password" name="confirm" required><br></br>
                    <input type="hidden" value="done" name="reset">
                    <input type="submit" value="Submit">
                    </form></center>
                    <br></br>
    


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
