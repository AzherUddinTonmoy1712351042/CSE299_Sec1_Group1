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

    public function getAllBrand(){
		$query= "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result=$this->db->select($query);
		return $result;

}

    public function getBrandById($id){
        $query= "SELECT * FROM tbl_brand WHERE brandId='$id'";//it catId match with ($id) which we sent then it will take.
		$result=$this->db->select($query);
		return $result;
    }

    public function brandUpdate($brandName,$id){
       $brandName=$this->fm->validation($brandName); //this function will tream space,backslash and secure data. 
	    $brandName=mysqli_real_escape_string($this->db->link, $brandName);//for avoiding single coutation in string.
        $id=mysqli_real_escape_string($this->db->link, $id);
	    If(empty($brandName)){
		   $msg= "<span class='error'>Brand must not be empty!</span>";
		   return $msg;
	     }
	     else{
	     	$query="UPDATE tbl_brand
	     	        SET brandName='$brandName'
	     	        WHERE brandId='$id'" ;
	     	$updated_row = $this->db->update($query);
	     	If($updated_row){
		   $msg = "<span class='success'>Brand updated successfully.</span>";
			return $msg;
	     }else{
		      $msg="<span class='error'>Brand not Updated successfully.</span>";
            return $msg;
	     }
	     }
    }
}

?>