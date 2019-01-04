<?php
class Ingredient{
    public $name = '';
    public $desc = '';
    public $img = '';
    public $price = '';
    public $csv = '';
}
function makeNewIngredient($name, $desc, $img, $price, $csv) {
	$i = new Ingredient ();
	$i->name = $name;
	$i->desc = $desc;
	$i->img = $img;
	$i->price = $price;
	$i->csv = $csv;
	return $i;
}
class Database extends PDO{
	
	public function __construct(){
		parent::__construct("sqlite:./Project2.db");
	}
	public function saveImage($imgArray, $ext){
		$sql = "INSERT INTO Images (Name, Type, Size, ext) VALUES (?,?,?,?)";
		$stm = $this->prepare($sql);
		$values = array(
			$imgArray["name"],
			$imgArray["type"],
			$imgArray["size"],
			$ext		
		);
		if($stm->execute($values) === FALSE){
			return -1;
		}else{
			return $this->lastInsertId("id");
		}
	}
	public function getImg($id){
		$sql = "SELECT * FROM images WHERE Name ='$id'";
		return $this->query($sql)->fetch(); 
	}
	
	public function saveIng($newIng){
	$name = $newIng->name;
	$desc = $newIng->desc;
	$img = $newIng->img;
	$price = $newIng->price;
	$csv = $newIng->csv;
		$sql = "INSERT INTO Ingredients (NAME, DESC, IMG, PRICE, COMMENTS) VALUES(?, ?, ?, ?, ?)";
		$stm = $this->prepare($sql);
		$values = array($name, $desc, $img, $price, $csv);
		
			echo $name . ', ' . $desc . ', ' . $img . ', ' . $price .', ' . $csv;	
		
		if($stm->execute($values) === FALSE){
			return -1;
		}else{
			return $this->lastInsertId("id");
		}
	}
	public function getIngredient($id){
		$sql = "SELECT * FROM Ingredients WHERE NAME = $id";
		$res = $this->query($sql);
		if($res === FALSE){
		echo '<pre class="bg-danger">';
			print_r ($sql);
			echo '</pre>';
		}
		else{
        return $this->query($sql)->fetch(); //->fetch()
        }
	}
	public function getIngredients(){
		$sql = "SELECT * FROM Ingredients";
		$res = $this->query($sql);
		
        return $res;
        
	}
	
	//name functions
	public function getNames(){
		$sql = "SELECT NAME FROM Ingredients";
		return $this->query($sql);
	}
	public function getName($id){
		$sql = "SELECT NAME FROM Ingredients WHERE NAME ='$id'";
		return $this->query($sql)->fetch(); 
	}
	
	//description functions
	public function getDescriptions(){
		$sql = "SELECT DESC FROM Ingredients";
		return $this->query($sql);
	}
	public function getDescription($id){
		$sql = "SELECT DESC FROM Ingredients WHERE NAME = $id";
		$res = $this->query($sql);
		if($res === FALSE){
		echo '<pre class="bg-danger">';
			print_r ($sql);
			echo '</pre>';
		}
		else{
        return $this->query($sql)->fetch(); //->fetch()
        }
	}
	
	//image functions
	public function getNumberOfImages(){
		$img_num = $this->query("SELECT Ingredients FROM INGS");
		return $img_num->fetchColumn();
	}
	
	public function getImages(){
		$sql = "SELECT IMG FROM Ingredients";
		return $this->query($sql);
	}
	
	public function getImage($id){
		$sql = "SELECT IMG FROM Ingredients WHERE NAME = $id";
		$res = $this->query($sql);
		if($res === FALSE){
		echo '<pre class="bg-danger">';
			print_r ($sql);
			echo '</pre>';
		}
		else{
		return $this->query($sql)->fetch();//->fetch() 
		}
	}
	
	
}
?>
