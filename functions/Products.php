<?php
class Products extends collection
{
	function __construct()
	{
		$this->load();
	}

	function validate(){
		return new Validate();
	}

	function load(){
		global $connection;
		$query = $connection->prepare('CALL select_products("")');
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$product = new Product();
			$product->setproductID($value["productID"]);
			$product->setDescription($value["description"]);
			$product->setSell_price($value["sell_price"]);
			$product->setCost_price($value["cost_price"]); 
			// $product->setCreate_date($value["date_created"]); 
			// $product->setModify_date($value["date_modified"]);
			$this->add($value["productID"], $product);
		}
	}
}
?>