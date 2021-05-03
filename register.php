<?php
include "functions/functions.php";
$errors = array('error_count'=>false, 'firstname'=>'', 'lastname'=>'',  'address'=>'', 'city'=>'' ,  'province'=>'', 'postalcode'=>'', 'username'=>'', 'pwd'=>'');

if(isset($_POST['submit']) == true){

	$in_firstname = htmlspecialchars($_POST["firstname"]);
	$in_lastname = htmlspecialchars($_POST["lastname"]);
	$in_address = htmlspecialchars($_POST["address"]);
	$in_city = htmlspecialchars($_POST["city"]);
	$in_province = htmlspecialchars($_POST["province"]);
	$in_postalcode = htmlspecialchars($_POST["postalcode"]);
	$in_username = htmlspecialchars($_POST["username"]);
	$in_pwd = htmlspecialchars($_POST["pwd"]);

	$customer = new Customer();

	$errors['firstname'] = $customer->setfirstname($in_firstname);
	$errors['lastname'] = $customer->setlastname($in_lastname);
	$errors['address'] = $customer->setAddress($in_address);
	$errors['city'] = $customer->setCity($in_city);
	$errors['province'] = $customer->setProvince($in_province);
	$errors['postalcode'] = $customer->setpostalcode($in_postalcode);
	$errors['username'] = $customer->setUsername($in_username);
	$errors['pwd'] = $customer->setpwd($in_pwd);
	
	$result = $customer->insert();
	if($result != false){
		$_SESSION['username'] = $in_username;
		$_SESSION['customersID'] = $result['uuid'];
		$_SESSION['logged_in'] = true;
		header("location:index.php");
	}
}

generateHeader("Register");

register($errors);
generateFooter();
?>