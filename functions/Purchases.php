<?php
class Purchases extends collection
{
	function __construct()
	{
		$this->load();
	}

    // returns an instance of validate
	function validate(){
		return new Validate();
	}

     // get data from database
	function load(){
		global $connection;
		$query = $connection->prepare('CALL select_purchase("")');
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$purchase = new Purchase();
			$purchase->setorderID($value["orderID"]);
			$purchase->setcustomersID($value["customersID"]);
			$purchase->setorderID($value["orderID"]);
			$purchase->setPrice($value["price"]);
			$purchase->setquantity($value["quantity"]);
			$purchase->setComment($value["comments"]); 
			$purchase->setdateOfPurchase($value["dateOfPurchase"]);
			$this->add($value["orderID"], $purchase);
		}
	}

    // function to search
	function search($in_customersID, $in_date = ""){
		global $connection;
		$query = $connection->prepare('CALL join_purchases(:in_customersID, :in_date)');
		$query->bindParam(":in_customersID", $in_customersID);
		$query->bindParam(":in_date", $in_date);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}

?>