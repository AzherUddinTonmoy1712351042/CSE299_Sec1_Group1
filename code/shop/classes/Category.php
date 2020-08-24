<?php
	 $filepath = realpath(dirname(__FILE__));
	 include_once ($filepath.'/../lib/Database.php');
	 include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class Category 
{
	private $db;
	private $fb;
	public function __construct()
	{
		$this->db =new Database();
		$this->fm =new Format();
	}
	public function catInsert($catName){
	$catName=$this->fm->validation($catName); //this function will tream space,backslash and secure data. 
	$catName=mysqli_real_escape_string($this->db->link, $catName);//for avoiding single coutation in string.

	If(empty($catName)){
		$msg= "<span class='error'>Category must not be empty!</span>";
		return $msg;
	}
	else{
		$query="INSERT INTO tbl_category(catName) values('$catName')";
		$catinsert=$this->db->insert($query);
		if($catinsert){
			$msg = "<span class='success'>category inserted successfully.</span>";
			return $msg;
		}
		else{ 
			$msg="<span class='error'>category not inserted successfully.</span>";
            return $msg;
		}
	}
	}
	public function getAllCat(){ //all category name have been selected from here. 
		$query= "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result=$this->db->select($query);
		return $result;
	}
	public function getCatById($id){
		$query= "SELECT * FROM tbl_category WHERE catId='$id'";//it catId match with ($id) which we sent then it will take.
		$result=$this->db->select($query);
		return $result;

	}
	public function catUpdate($catName,$id){
		$catName=$this->fm->validation($catName); //this function will tream space,backslash and secure data. 
	    $catName=mysqli_real_escape_string($this->db->link, $catName);//for avoiding single coutation in string.
        $id=mysqli_real_escape_string($this->db->link, $id);
	    If(empty($catName)){
		   $msg= "<span class='error'>Category must not be empty!</span>";
		   return $msg;
	     }
	     else{
	     	$query="UPDATE tbl_category
	     	        SET catName='$catName'
	     	        WHERE catId='$id'" ;
	     	$updated_row = $this->db->update($query);
	     	If($updated_row){
		   $msg = "<span class='success'>category updated successfully.</span>";
			return $msg;
	     }else{
		      $msg="<span class='error'>category not Updated successfully.</span>";
            return $msg;
	     }
	     }

	} 

	public function delCatById($id){
		$id=mysqli_real_escape_string($this->db->link, $id);

		$query = "DELETE FROM tbl_category WHERE catId = '$id'";
		$deldata = $this->db->delete($query);
		if ($deldata) {
			$msg="<span class='success'>category deleted successfully.</span>";
            return $msg;
		}else{
			$msg="<span class='error'>category not deleted.</span>";
            return $msg;
		}
	}
}
?>