<?php
class Purchase
{ 
	// declaring variables
	private $_orderID, $_customersID, $_productID, $_price, $_subtotal_price, $_taxes, $_total_price, $_quantity, $_commentss, $_dateOfPurchase;

     // function which accepts optional fields
	function __construct($orderID = "", $customersID = "", $productID = "", $price = 0, $quantity = 0, $commentss = "", $dateOfPurchase = "")
	{
		$this->_orderID = $orderID;
		$this->_customersID = $customersID;
		$this->_productID = $productID;
		$this->_price = $price;
		$this->_quantity = $quantity;
		$this->_commentss = $commentss;
		$this->_dateOfPurchase = $dateOfPurchase;
		$this->setTaxes();
	}

    // returns an instance of validate
	function validate(){
		return new Validate();
	}

    // begining of getters

    // getting purchase code
	function getorderID(){
		return $this->_orderID;
	}

    // getting customer code
	function getcustomersID(){
		return $this->_customersID;
	}

    // getting product code
	function getproductID(){
		return $this->_productID;
	}

   // getting price
	function getPrice(){
		return $this->_price;
	}
	 

    // getting subtoatal price
	function getSubtotal_price(){
		return $this->_subtotal_price;
	}

     // getting taxes
	function getTaxes(){
		return $this->_taxes;
	}

    // getting toatl price
	function getTotal_price(){
		return $this->_total_price;
	}

 
    // getting qunatity
     
	function getquantity(){
		return $this->_quantity;
	}

    // to get commentss 
	function getcomments(){
		return $this->_commentss;
	}

     // to get the order date
	function getdateOfPurchase(){
		return $this->_dateOfPurchase;
	}

	//end of getters

	// begining of setters


    // setting the cust code
	function setcustomersID($data){
		$this->_customersID = $data;
	}

     // setting the purchase code
	function setorderID($data){
		$this->_orderID = $data;
	}


	 // setting prod code
	function setproductID($data){
		$this->_productID = $data;
	}

    // setting the price
	function setPrice($data){
		$valid = $this->validate()->price($data, MIN_PRODUCT_PRICE, MAX_PRODUCT_PRICE);
		if($valid == ''){
			$this->_price = $data;
			$this->setTaxes();
		}
		return $valid;
	}

     // setting the taxes
	function setTaxes($data = 0){
		if($data == 0){
			$this->_subtotal_price = round($this->_price * $this->_quantity, 2);
			$this->_taxes = round(($this->_subtotal_price * TAX_RATE)/100,2);
			$this->_total_price = round($this->_taxes + $this->_subtotal_price, 2);
		}else{
			$this->_taxes = $data;
		}
	}

     // setting the subtoatal price
	function setSubtotal_price($data){
		$this->_subtotal_price = $data;
	}

    
    // setting the total price 
	function setTotal_price($data){
		$this->_total_price = $data;
	}

     // setting quantity
	function setquantity($data){
		$valid = $this->validate()->quantity($data, MIN_ORDER_QUANTITY, MAX_ORDER_QUANTITY);
		if($valid == ''){
			$this->_quantity = $data;
			$this->setTaxes();
		}
		return $valid;
	}

    // setting commentss
	function setcomments($data){
		$valid = $this->validate()->length("comments", $data, MIN_commentssS_LENGTH, MAX_commentssS_LENGTH);
		if($valid == ''){
			$this->_commentss = $data;
		}
		return $valid;
	}

     // setting order date 
	function setdateOfPurchase($data){
		$this->_dateOfPurchase = $data;
	}

	//end of setters


     // to insert data into the table purchase
	function insert(){
		
		global $connection;
		$query = $connection->prepare('CALL insert_into_purchases(:productID, :customersID,  :price, :subtotal_price, :taxes, :total_price, :quantity, :comments)');
		$query->bindParam(':customersID', $this->_customersID);
		$query->bindParam(':productID', $this->_productID);
		$query->bindParam(':price', $this->_price);
		$query->bindParam(':subtotal_price', $this->_subtotal_price);
		$query->bindParam(':taxes', $this->_taxes);
		$query->bindParam(':total_price', $this->_total_price);
		$query->bindParam(':quantity', $this->_quantity);
		$query->bindParam(':comments', $this->_commentss);
		$query->execute();
	}




    // get data from database
	function load($data){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL select_purchase(:data)');
		$query->bindParam(':data', $data);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		//echo "<pre>" . print_r($result, true) . "</pre>";
		if(count($result) > 0){
			$this->_orderID = $result["orderID"];
			$this->_customersID = $result["customersID"];
			$this->_productID = $result["productID"];
			$this->_price = $result["price"];
			$this->_quantity = $result["quantity"];
			$this->_commentss = $result["comments"];
			$this->_dateOfPurchase = $result["dateOfPurchase"];
		}else{
			$errors["order"] = "Order not found!";
			$errors["error_count"] = true;
		}
	}

   // update the record on database 
	function update(){
		global $errors;

		global $connection;
		$query = $connection->prepare('CALL update_purchase(:orderID, :price, :subtotal_price, :taxes, :total_price, :quantity, :comments)');
		$query->bindParam(':orderID', $this->_orderID);
		$query->bindParam(':price', $this->_price);
		$query->bindParam(':subtotal_price', $this->_subtotal_price);
		$query->bindParam(':taxes', $this->_taxes);
		$query->bindParam(':total_price', $this->_total_price);
		$query->bindParam(':quantity', $this->_quantity);
		$query->bindParam(':comments', $this->_commentss);
		$query->execute();
	}

    // to delete from database
	function delete(){
		global $connection;
		$query = $connection->prepare('CALL delete_from_purchases(:orderID)');
		$query->bindParam(':orderID', $this->_orderID);
		$query->execute();
	}
}

?>