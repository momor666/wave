<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER["DOCUMENT_ROOT"]."/config/db-connect.php";
class CategoryController {
	private $db;
	private $db_table = "category";
	public function __construct(){
		$this->db = new DbConnect();
	}
	//Ангилалын мэдээлэл өгөгдлийн санд нэмэх
	public function create($name, $image){
		$query = "INSERT INTO category (`cat_name`, `cat_image`)
					VALUES('$name', '$image')";
		$inserted = mysqli_query($this->db->getDb(), $query);
		if ($inserted == 1) {
			$json['success'] = 1;
		} else {
			$json['success'] = 0;
		}
		var_dump($query);
		mysqli_close($this->db->getDb());
	}
}
?>