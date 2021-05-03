<?php 

class Product
{
	// declaring variables
	private $_productID, $_description, $_sell_price, $_cost_price, $date_created, $date_modified;

    // function which accepts optional fields
	function __construct($productID = "", $description = "", $sell_price = "", $cost_price = "", $date_created = "", $date_modified = "")
	{
		$this->_productID = $productID;
		$this->_description = $description;
		$this->_sell_price = $sell_price;
		$this->_cost_price = $cost_price;
		$this->_date_created = $date_created;
		$this->_date_modified = $date_modified;
	}

    // returns an instance of validate
	function validate(){
		return new Validate();
	}

     // begining of getters


	// getting product code
	function getproductID(){
		return $this->_productID;
	}


    // getting description 
	function getDescription(){
		return $this->_description;
	}

   
    // getting sell price
	function getSell_price(){
		return $this->_sell_price;
	}

    // getting cost price
	function getCost_price(){
		return $this->_cost_price;
	}

    // getting create date
	function getdate_created(){
		return $this->_date_created;
	}

     // getting modify date
	function getdate_modified(){
		return $this->_date_modified;
	}

	//end of getters


    // begining of setters

    // setting prod code
	function setproductID($data){
		$this->_productID = $data;
	}

    // setting description 
	function setDescription($data){
		$valid = $this->validate()->length("Description", $data, MIN_PROD_DESC_LENGTH, MAX_PROD_DESC_LENGTH);
		if($valid == ''){
			$this->_description = $data;
		}
		return $valid;
	}

    // setting sell price
	function setSell_price($data){
		$valid = $this->validate()->price($data, MIN_PRODUCT_PRICE, MAX_PRODUCT_PRICE);
		if($valid == ''){
			$this->_sell_price = $data;
		}
		return $valid;
	}

     // setting cost price
	function setCost_price($data){
		$valid = $this->validate()->price($data, MIN_PRODUCT_PRICE, MAX_PRODUCT_PRICE);
		if($valid == ''){
			$this->_cost_price = $data;
		}
		return $valid;
	}


     // setting created date
	function setdate_created($data){
		$this->_date_created = $data;
	}

    // setting modify date
	function setdate_modified($data){
		$this->_date_modified = $data;
	}
 
   // end of setters

 
    // to insert data into the table product
	function insert(){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL select_products(:productID)');
		$query->bindParam(':productID', $this->_productID);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if($result['count'] == 0){
			$query = $connection->prepare('CALL insert_into_products(:description, :cost_price, :sell_price)');
			$query->bindParam(':description', $this->_description);
			$query->bindParam(':cost_price', $this->_cost_price);
			$query->bindParam(':sell_price', $this->_sell_price);
			$query->execute();
			return $query->fetch(PDO::FETCH_ASSOC);
		}else{
			$errors['productID'] = "Username is already taken, choose another...";
			$errors['error_count'] = true;
			return false;
		}
	}


    // get data from database
	function load($data){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL select_products(:data)');
		$query->bindParam(':data', $data);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if(count($result) > 0){
			$this->_productID = $result["productID"];
			$this->_description = $result["description"];
			$this->_sell_price = $result["sell_price"];
			$this->_cost_price = $result["cost_price"];
			$this->_date_created = $result["date_created"];
			$this->_date_modified = $result["date_modified"];
		}else{
			$errors["product"] = "Product not found!";
			$errors["error_count"] = true;
		}
	}


   // update the record on database 
	function update(){
		global $errors;
		global $connection;
		$result['count'] = 0;

		$query = $connection->prepare('CALL update_product(:productID, :prod_name, :description, :cost_price, :sell_price)');
		$query->bindParam(':productID', $this->_productID);
		$query->bindParam(':description', $this->_description);
		$query->bindParam(':cost_price', $this->_cost_price);
		$query->bindParam(':sell_price', $this->_sell_price);
		$query->execute();
	}


     // to delete from database
	function delete(){
		global $connection;
		$query = $connection->prepare('CALL delete_from_product(:productID)');
		$query->bindParam(':productID', $this->_productID);
		$query->execute();
	}
}


 ?>