<?php

class Customer
{
	// declaring variables
	private $_customersID, $_firstname, $_lastname, $_address, $_city, $_province, $_postalcode, $_username, $_pwd, $_create_date, $_username_changed = 0;

    // function which accepts optional fields
	function __construct($customersID = "", $firstname = "", $lastname = "", $address = "", $city = "", $province = "", $postalcode = "", $username = "", $pwd = "", $create_date = "")
	{
		$this->_customersID = $customersID;
		$this->_firstname = $firstname;
		$this->_lastname = $lastname;
		$this->_address = $address;
		$this->_city = $city;
		$this->_province = $province;
		$this->_postalcode = $postalcode;
		$this->_username = $username;
		$this->_pwd = $pwd;
		$this->_create_date = $create_date;
	}

    // returns an instance of validate
	function validate(){
		return new Validate();
	}

    // begining of getters

    //to get the cust code
	function getcustomersID(){
		return $this->_customersID;
	}
    
    //to get the first name
	function getfirstname(){
		return $this->_firstname;
	}


    //function to getlastname
	function getlastname(){
		return $this->_lastname;
	}


    // to get the address 
	function getAddress(){
		return $this->_address;
	}

    // to get the city
	function getCity(){
		return $this->_city;
	}

    
    // to get the province
	function getProvince(){
		return $this->_province;
	}

    // to get Postal Code
	function getpostalcode(){
		return $this->_postalcode;
	}


    // to get the username
	function getUsername(){
		return $this->_username;
	}

    
    // to get the pwd
	function getpwd(){
		return $this->_pwd;
	}

    // to get the date
	function getCreate_date(){
		return $this->_create_date;
	}

	//end of getters

	// begining of setters


    // setting customer code
	function setcustomersID($data){
		$this->_customersID = $data;
	}


    // setting firstname
	function setfirstname($data){
		$result = $this->validate()->length("First Name", $data, MIN_NAME_LENGTH, MAX_NAME_LENGTH);
		if($result == ''){
			$this->_firstname = $data;
		}
		return $result;
	}

    // setting lastname
	function setlastname($data){
		$result = $this->validate()->length("Last Name", $data, MIN_NAME_LENGTH, MAX_NAME_LENGTH);
		if($result == ''){
			$this->_lastname = $data;
		}
		return $result;
	}

     // setting address
	function setAddress($data){
		$result = $this->validate()->length("Address", $data, MIN_NAME_LENGTH, MAX_ADDRESS_LENGTH);
		if($result == ''){
			$this->_address = $data;
		}
		return $result;
	}

    // setting city
	function setCity($data){
		$result = $this->validate()->length("City", $data, MIN_NAME_LENGTH, MAX_CITY_LENGTH);
		if($result == ''){
			$this->_city = $data;
		}
		return $result;
	}

     // setting province 
	function setProvince($data){
		$result = $this->validate()->length("Province", $data, MIN_PROVINCE_LENGTH, MAX_PROVINCE_LENGTH);
		if($result == ''){
			$this->_province = $data;
		}
		return $result;
	}

     // setting zipcode
	function setpostalcode($data){
		$result = $this->validate()->length("Postal Code", $data, MIN_postalcode_LENGTH, MAX_postalcode_LENGTH);
		if($result == ''){
			$this->_postalcode = $data;
		}
		return $result;
	}

     // setting username
	function setUsername($data){
		$result = $this->validate()->length("Username", $data, MIN_USERNAME_LENGTH, MAX_USERNAME_LENGTH);
		if($result == ''){
			if($this->_username != $data){
				$this->_username = $data;
				$this->_username_changed = 1;
			}else if($this->_username == $data){
				$this->_username_changed = 0;
			}
		}
		return $result;
	}

    
    // setting pwd
	function setpwd($data){
		$result = $this->validate()->length("pwd", $data, MIN_pwd_LENGTH, MAX_pwd_LENGTH);
		if($result == ''){
			$this->_pwd = md5($data);
		}
		return $result;
	}

	function setCreate_date($data){
		$this->_create_date = $data;
	}

	//end of senders
     
    // to insert data into customers
	function insert(){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL customer_exists(:username)');
		$query->bindParam(':username', $this->_username);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if($result['count'] == 0){
			$query = $connection->prepare('CALL insert_into_customers(:firstname, :lastname, :address, :city, :province, :postalcode, :username, :pwd)');
			$query->bindParam(':firstname', $this->_firstname);
			$query->bindParam(':lastname', $this->_lastname);
			$query->bindParam(':address', $this->_address);
			$query->bindParam(':city', $this->_city);
			$query->bindParam(':province', $this->_province);
			$query->bindParam(':postalcode', $this->_postalcode);
			$query->bindParam(':username', $this->_username);
			$query->bindParam(':pwd', $this->_pwd);
			$query->execute();

			return $query->fetch(PDO::FETCH_ASSOC);
		}else{
			$errors['username'] = "Username is already taken, choose another...";
			$errors['error_count'] = true;
			return false;
		}
	}

     // get data from database
	function load($data){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL select_customer(:data)');
		$query->bindParam(':data', $data);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if(count($result) > 0){
			$this->customersID = $result["customersID"];
			$this->_firstname = $result["firstname"];
			$this->_lastname = $result["lastname"];
			$this->_address = $result["address"];
			$this->_city = $result["city"];
			$this->_province = $result["province"];
			$this->_postalcode = $result["postalcode"];
			$this->_username = $result["username"];
			$this->_pwd = $result["pwd"];
			$this->_create_date = $result["create_date"];
		}else{
			$errors["customer"] = "Product not found!";
			$errors["error_count"] = true;
		}
	}

    // update the record on database 
	function update(){
		global $errors;
		global $connection;
		//$result = array();
		$result['count'] = 0;
		
		if($this->_username_changed == 1){
			$query = $connection->prepare('CALL customer_exists(:username)');
			$query->bindParam(':username', $this->_username);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
		}
		if($result['count'] == 0){

			$query = $connection->prepare('CALL update_customer(:customersID, :firstname, :lastname, :address, :city, :province, :postalcode, :username, :pwd)');
			$query->bindParam(':customersID', $this->customersID);
			$query->bindParam(':firstname', $this->_firstname);
			$query->bindParam(':lastname', $this->_lastname);
			$query->bindParam(':address', $this->_address);
			$query->bindParam(':city', $this->_city);
			$query->bindParam(':province', $this->_province);
			$query->bindParam(':postalcode', $this->_postalcode);
			$query->bindParam(':username', $this->_username);
			$query->bindParam(':pwd', $this->_pwd);
			$query->execute();
		}else{
			$errors['username'] = "Username is already taken, choose another...";
			$errors['error_count'] = true;
		}
	}

    // to delete from database
	function delete(){
		$query = $connection->prepare('CALL delete_from_customer(:customersID)');
		$query->bindParam(':customersID', $this->customersID);
		$query->execute();
	}


    // function to return customer pwd
	function login(){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL `get_customer_pwd`(:data)');
		$query->bindParam(':data', $this->_username);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if($result == null){
			$errors['username'] = 'username does not exist in our database';
			$errors['error_count'] = true;
			return false;
		}elseif ($result["pwd"] != $this->_pwd) {
			$errors['pwd'] = 'the entered pwd is not correct';
			$errors['error_count'] = true;
			return false;
		}elseif ($result["pwd"] == $this->_pwd) {
			$_SESSION['username'] = $this->_username;
			$_SESSION['customersID'] = $result["customersID"];
			$_SESSION['logged_in'] = true;
			return true;
		}
	}
}



?>