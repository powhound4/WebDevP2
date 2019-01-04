<?php
include('config.php');

session_start();
require_once './database.php';
if($_SESSION['admin'] == FALSE){
header("Location: ./frontpage");
}
function parseFileSuffix($iType) {
	if ($iType == 'image/jpeg') {
		return 'jpg';
	}
	if ($iType == 'image/gif') {
		return 'gif';
	}
	if ($iType == 'image/png') {
		return 'png';
	}
	if ($iType == 'image/tif') {
		return 'tif';
	}
	return '';
}

function setupConnection() {
	try {
		$dbh = new PDO ( "sqlite:./Project2.db" );
		//echo '<pre class="bg-success">';
		echo '<center> Connection successful. </center>';
		//echo '</pre>';
		return $dbh;
	} catch ( PDOException $e ) {
		echo '<pre class="bg-danger">';
		echo 'Connection failed (Help!): ' . $e->getMessage ();
		echo '</pre>';
		return FALSE;
	}
}
$max_file_size = 1000000;
$db = new Database ();
if(isset($_POST['create'])){
$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$des = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
$price = filter_var($_POST["price"], FILTER_SANITIZE_STRING);
if ($_FILES && isset ( $_FILES ["image"] )) { 
	if ($_FILES ["image"] ["error"] == UPLOAD_ERR_OK) {
		/*if ($_FILES ["image"] ["size"] > $max_file_size) {
			$error_msg = "File is too large.";
		} */
		//else {
			$ext = parseFileSuffix ( $_FILES ['image'] ['type'] );
			//echo $_FILES ['image']['name'];
			if ($ext == '') {
				$error_msg = "Unknown file type";
			} 
			if($ext != 'png'){
			$error_msg = "Must be a png File";
			}
			else {
				// save info to database
				$fid = $db->saveImage($_FILES ["image"], $ext);
				//echo "fid = " . $fid;
				//echo "image = " . $_FILES["image"];
				if ($fid == - 1) {
					$error_msg = "Unable to store image in DB";
				} 
				else {
					if (! file_exists ( "/s/bach/n/under/powhound/public_html/project2/" )) {
						if (! mkdir ( "/s/bach/n/under/powhound/public_html/project2/")) {
							$error_msg = "Attempt to make folder: \"" . '/s/bach/n/under/powhound/public_html/project2/' . "\" failed";
						}
					}
					$filename = str_pad ( $fid, 4, "0", STR_PAD_LEFT ) . "." . $ext;
					$ing = array();
                    $i = 0;
                    $ing[$i++] = makeNewIngredient($name, $des, $filename, $price, $_POST["csv"]);
                    $db->saveIng($ing[0]);
					move_uploaded_file ( $_FILES ["image"] ["tmp_name"], "/s/bach/n/under/powhound/public_html/project2/" . $filename );
					chmod("/s/bach/n/under/powhound/public_html/project2/" . $filename, 0755);
					//echo "/s/bach/n/under/powhound/public_html/project2/" . $filename;
				}
			}
		//}
	} else if ($_FILES ["image"] ["error"] == UPLOAD_ERR_INI_SIZE || $_FILES ["image"] ["error"] == UPLOAD_ERR_FORM_SIZE) {
		$error_msg = "File is too large.";
	} else {
		$error_msg = "An error occured. Please try again. <!-- " . $_FILES ["image"] ["error"] . " -->";
	}
}
}

    
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<TITLE>MTN EATZ - Create New Ingredient </TITLE>
<meta name="author" content="George Hatch, Alison Finnman" />
<meta name="keywords" content= "CT310, Login, IFY" />
<meta name="description" content="create ingredient" />




<?php include('inc.head.php');?>
</head>
<body>


		<?php include('inc.header.php');?>



<?php include('inc.navbar.php');?>
    		<div class="container-fluid">
	
		<div class="row1">
            <h1>Create New Ingredient</h1>
		</div>

<div>
    
       

<div class="row">
	<br></br> 	
	<?php
    setupConnection();
    ?>
    <?php
			if (isset ( $error_msg )) {
				echo "<div class=\"bg-danger\"> $error_msg </div>";
			}
			?>
        <center><form method="POST" enctype = "multipart/form-data" action="#">
        <input type="text" placeholder="Enter Name" name="name" required><br></br>
        <input type="text" placeholder="Enter Description" name="description" required><br></br>
        
        <br>.png only</br><label class="fileUpload">
        <input type="file" name="image" required></label>
        
        <br>Example: $.45/lb</br><input type="text" placeholder="Enter Price" name="price" required><br></br>
        <br>Example: food.csv</br><input type="text" placeholder="Enter a CSV File Name" name="csv" required><br></br>
        <input type="hidden" value="done" name="create">
        <input type="submit" value="Create New Ingredient">
        </form></center>
        <br></br>

                  

</div>
                

	<?php include('inc.footer.php');?>


</div>


</html>
