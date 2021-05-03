<?php


include "functions/functions.php";
$errors = ['error_count'=>false, 'username'=>'', 'pwd'=>''];

if(isset($_POST['submit']) == true){

	$in_username = htmlspecialchars($_POST["username"]);
	$in_pwd = htmlspecialchars($_POST["pwd"]);

	$customer = new Customer();
	
	$errors['username'] = $customer->setUsername($in_username);
	$errors['pwd'] = $customer->setpwd($in_pwd);

	$result = $customer->login();
	
	if($result == true){
		header('location:index.php');
	}
}


generateHeader("Login");

login($errors);
generateFooter();

?>