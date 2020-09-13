<?php
	 $filepath = realpath(dirname(__FILE__));
	 include_once ($filepath.'/../lib/Database.php');
	 include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Customer{
	private $db;
	private $fb;
	public function __construct()
	{
		$this->db =new Database();
		$this->fm =new Format();
	}

	public function customerRegistration($data){
		
     $name       =mysqli_real_escape_string($this->db->link, $data['name']);
     $address       =mysqli_real_escape_string($this->db->link, $data['address']);
     $city       =mysqli_real_escape_string($this->db->link, $data['city']);
     $country       =mysqli_real_escape_string($this->db->link, $data['country']);
     $zip       =mysqli_real_escape_string($this->db->link, $data['zip']);
     $phone       =mysqli_real_escape_string($this->db->link, $data['phone']);
     $email       =mysqli_real_escape_string($this->db->link, $data['email']);
     $pass       =mysqli_real_escape_string($this->db->link, md5($data['pass']));
     

     if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == ""|| $pass == "" ) {
    	$msg= "<span class='error'>Fields must not be empty!</span>";
		return $msg;
    }
    $mailquery= "SELECT * FROM tbl_customer WHERE email='$email' Limit 1 ";
    $mailchk=$this->db-> select($mailquery);
    if($mailchk != false){
    	$msg= "<span class='error'>Email Already exists! </span>";
		return $msg;
    }else{
    	$query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,pass) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
        $inserted_row=$this->db->insert($query);

		if($inserted_row){
			$msg = "<span class='success'>Customer Data inserted successfully.</span>";
			return $msg;
		}
		else{ 
			$msg="<span class='error'>Customer Data not inserted successfully.</span>";
            return $msg;
      

		}
    }
	}
	public function customerLogin($data){
		$email       =mysqli_real_escape_string($this->db->link, $data['email']);
		$pass       =mysqli_real_escape_string($this->db->link, md5($data['pass']));

		if (empty($email) || empty($pass)) {
			$msg= "<span class='error'>Fields must not be empty!</span>";
		return $msg;
		}

		$query= "SELECT * FROM tbl_customer WHERE email= '$email' AND pass= '$pass' ";
		$result= $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			Session :: set("cuslogin", true);
			Session :: set("cmrId", $value['id']);
			Session :: set("cmrName", $value['name']);
			header("Location:order.php");
		}	else{
					$msg= "<span class='error'>Email or Password not matched!</span>";
					return $msg;
		}
	}

}
?>