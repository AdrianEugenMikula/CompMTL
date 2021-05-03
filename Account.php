<?php
include "functions/functions.php";

$errors = array('error_count'=>false, 'firstname'=>'', 'lastname'=>'', 'address'=>'', 'city'=>'', 'province'=>'', 'postalcode'=>'', 'username' => '', 'pwd' => '', 'success'=>'', 'old_pwd'=>'', 'new_pwd'=>'', 'confirm_new_pwd'=>'');


$customer_data = new Customer();
$customer_data->load($_SESSION["customersID"]);


/ to check if the post was created
if(!empty($_POST) == true){
	$validate = Validate::getInstance();

	if(isset($_POST['submit-info']) == true){

		$in_firstname = $validate->sanitize($_POST['firstname']);
		$in_lastname = $validate->sanitize($_POST['lastname']);
		$in_address = $validate->sanitize($_POST['address']);
		$in_city = $validate->sanitize($_POST['city']);
		$in_province = $validate->sanitize($_POST['province']);
		$in_postalcode = $validate->sanitize($_POST['postalcode']);
		$in_username = $validate->sanitize($_POST['username']);

		$errors['firstname'] = $customer_data->setfirstname($in_firstname);
		$errors['lastname'] = $customer_data->setlastname($in_lastname);
		$errors['address'] = $customer_data->setAddress($in_address);
		$errors['city'] = $customer_data->setCity($in_city);
		$errors['province'] = $customer_data->setProvince($in_province);
		$errors['postalcode'] = $customer_data->setpostalcode($in_postalcode);
		$errors['username'] = $customer_data->setUsername($in_username);
		if($errors['error_count'] == false){
			$customer_data->update();
			if($errors['error_count'] == false){
				header("location:account.php");
			}
		}
	}else if(isset($_POST['submit-pwd']) == true){
		$in_old_pwd = $validate->sanitize($_POST['old_pwd']);
		$in_new_pwd = $validate->sanitize($_POST['new_pwd']);
		$in_confirm_new_pwd = $validate->sanitize($_POST['confirm_new_pwd']);

		$hash_in_old_pwd = md5($in_old_pwd);
		$hash_in_new_pwd = md5($in_new_pwd);
		$hash_in_confirm_new_pwd = md5($in_confirm_new_pwd);
		
		if($customer_data->getpwd() == $hash_in_old_pwd){
			if($hash_in_new_pwd == $hash_in_confirm_new_pwd){
				if($hash_in_old_pwd == $hash_in_new_pwd){
					$errors['new_pwd'] = 'Same pwd as the current pwd';
				}else{
					$errors['new_pwd'] = $customer_data->setpwd($in_new_pwd);
					if($errors['error_count'] == false){
						$customer_data->update();
						if($errors['error_count'] == false){
							header("location:account.php");
						}
					}
				}
			}else{
				$errors['confirm_new_pwd'] = 'pwd must match the new one!';
				$errors['error_count'] = true;
			}
		}else{
			$errors['old_pwd'] = 'pwd incorrect!';
			$errors['error_count'] = true;
		}
	}
}


// createPageHeader($_SESSION["username"] . " | Account details");
// createNavigationMenu();

account($errors);

?>