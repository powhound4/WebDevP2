<?php
include('config.php');
session_start();
include('inc.functions.php');
if(isset($_POST['op'])){
    $_SESSION["ValidUser"] = "FALSE";
    $_SESSION["admin"] ="FALSE";
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $admin = readAdmin();
    for($i=0; $i < count($admin); $i++){
        if($admin[$i]->username == $username && password_verify($_POST['password'], $admin[$i]->hash)){
            $_SESSION["UserName"] = $username;
            $_SESSION["ValidUser"] = "TRUE";
            $_SESSION['email']= $admin[$i]->email;
            $_SESSION["Timestamp"] = date("m/d/Y") . " at " .date("h:i:s a");
            $_SESSION["admin"] ="TRUE";
        }
        
    }
    
    if($_SESSION["admin"] == "FALSE"){
        $users = readUsers();
        for($i=0; $i < count($users); $i++){
            if($users[$i]->username == $username && password_verify($_POST['password'], $users[$i]->hash)){
                $_SESSION["UserName"] = $username;
                $_SESSION["ValidUser"] = "TRUE";
                $_SESSION['email']= $admin[$i]->email;
                $_SESSION["Timestamp"] = date("m/d/Y") . " at " .date("h:i:s a");
            }
        }
    }
    
    $sessName = "p2_" . $username . "_session";
    $fileName = $sessName . ".txt";
        
    if(file_exists($fileName) && strlen(file_get_contents($fileName))!= 0){
        $handle = fopen($fileName, "r");
        $_SESSION["LastLogIn"] = fgets($handle);
        fclose($handle);
    }
    else{
        $handle = fopen($fileName, "w");
        fwrite($handle, $_SESSION["Timestamp"]);
        $_SESSION["LastLogIn"] = $_SESSION["Timestamp"];  
        fclose($handle);
    }
    //header("Location: ./login.php");

    }

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<TITLE>MTN EATZ - Login </TITLE>
<meta name="author" content="George Hatch, Alison Finnman" />
<meta name="keywords" content= "CT310, Login, IFY" />
<meta name="description" content="login page" />




<?php include('inc.head.php');?>
</head>
<body>


		<?php include('inc.header.php');?>



<?php include('inc.navbar.php');?>
    		<div class="container-fluid">
	
		<div class="row1">
            <h1>Welcome</h1>
            <p>Choose from our three ingredients to help you spice up your life!</p>
		</div>

<div>
    
       

<div class="row">
	<br></br> 	
<center><?php

    if(isset($_SESSION["UserName"])){?>
    <h2><center>Login Successful</center></h2><br></br>
	
        <center> <?php echo "Hello again "  . $_SESSION["UserName"] . "! The last time you logged in was on " . $_SESSION["LastLogIn"]; ?> </center><br>
   <?php }
    
    else{
     if(isset($_SESSION["ValidUser"]) && $_SESSION["ValidUser"] == "FALSE"){ 
        echo "***Invalid username or password***"; 
        } ?>
        <center><form method="POST" action="./login.php">
        <input type="text" placeholder="Enter Username" name="username" required><br></br>
        <input type="password" placeholder="Enter Password" name="password" required><br></br>
        <input type="hidden" value="done" name="op">
        <input type="submit" value="Log In">
        </form></center>
        <br></br>
<?php }
?>
                  <center><a href= ./fmp class = "help">Forgot My Password</a></center>

</div>
                

	<?php include('inc.footer.php');?>


</div>


</html>
