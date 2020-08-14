<?php
	include_once '../lib/Database.php';
    include_once '../helpers/Format.php';
?>

<?php
class Brand{ 

	private $db;
	private $fb;

	public function __construct(){

		$this->db =new Database();
		$this->fm =new Format();
	}
	public function brandInsert($brandName){
	$brandName=$this->fm->validation($brandName); //this function will tream space,backslash and secure data. 
	$brandName=mysqli_real_escape_string($this->db->link, $brandName);//for avoiding single coutation in string.

	If(empty($brandName)){
		$msg= "<span class='error'>Brand must not be empty!</span>";
		return $msg;
	}
	else{
		$query="INSERT INTO tbl_brand(brandName) values('$brandName')";
		$brandinsert=$this->db->insert($query);
		if($brandinsert){
			$msg = "<span class='success'>Brand inserted successfully.</span>";
			return $msg;
		}
		else{ 
			$msg="<span class='error'>Brand not inserted successfully.</span>";
            return $msg;
		}
	}
	}
	
}

?>