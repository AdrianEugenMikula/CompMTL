<?php

include "functions/functions.php";

generateHeader ("CompMTL Home Page");


generateBody_WHITEBACKGROUND();

echo '<br>';

$errors = array('error_count'=>false,'productID' => '', 'firstname' => '', 'lastname' => "", 'city' => '', 'comments' => '', 'price' => '', 'quantity' => '', 'success' => '');

$product_data = new Products();

buy($errors);

//validateForm();

if(isset($_POST['submit'])){//To check  if the form is submited
	if(isset($_POST['productID'])){

		$in_productID = htmlspecialchars($_POST['productID']);//declare, initialize a variable to hold the sanitized data from the corresponding input field from the form
		$in_quantity = htmlspecialchars($_POST['quantity']);//declare, initialize a variable to hold the sanitized data from the corresponding input field from the form
		$in_comments = htmlspecialchars($_POST['comments']);//declare, initialize a variable to hold the sanitized data from the corresponding input field from the form

		$purchase = new Purchase();
		$product = new Product();

		$product->load($in_productID);

		if($in_productID == "none"){
			$errors["productID"] = "Please select at least one product";
			$errors["error_count"] = true;
		}

		if($errors["error_count"] == false){
			$errors["productID"] = $purchase->setproductID($in_productID);
			$errors["customersID"] = $purchase->setcustomersID($_SESSION["customersID"]);
			$purchase->setPrice($product->getSell_price());
			$purchase->setTaxes();
			$errors["quantity"] = $purchase->setquantity($in_quantity);
			$errors["comments"] = $purchase->setComment($in_comments);
			
			//checking if there are no errors so we can save data which doesn't have errors in it
			if($errors['error_count'] === false){
				$purchase->insert();
				header("location:buy.php?success=true");
			}
		}
	}
}




?>