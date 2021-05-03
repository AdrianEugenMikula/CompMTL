<?php 

class Customers extends collection
{
	function __construct()
	{
		$this->load();
	}

    //// returns an instance of validate
	function validate(){
		return new Validate();
	}

    // to load the database
	function load(){
		global $errors;
		global $connection;
		$query = $connection->prepare('CALL select_customer("")');
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $key => $value) {
			$customer = new Customer();
			$customer->setcustomersID($value["customersID"]);
			$customer->setfirstname($value["firstname"]);
			$customer->setlastname($value["lastname"]);
			$customer->setAddress($value["address"]);
			$customer->setCity($value["city"]); 
			$customer->setProvince($value["province"]); 
			$customer->setpostalcode($value["postalcode"]); 
			$customer->setUsername($value["username"]);
			$customer->setCreate_date($value["create_date"]);
			$this->add($value["customersID"], $customer);
		}
	}
}
?>

?>