<?php

class Validate
{
	
	public function __construct()
	{}
	
	

      // for validating the charcter length

	function length($field, $data, $min, $max){
		global $errors;

		if(strlen($data) > $max || strlen($data) < $min){
			$errors['error_count'] = true;
			return $field . " can't be less that " . $min . " character(s) or longer than " . $max . " characters.";
		}else{
			return '';
		}
	}

    // for validating the price
	function price($data, $min, $max){
		global $errors;

		if(is_numeric($data) == false){
			$errors['error_count'] = true;
			return 'Price Should only contain numbers';
		}else if($data < $min){
			$errors['error_count'] = true;
			return 'Price cannot be lower than' . $min;
		}else if($data > $max){
			$errors['error_count'] = true;
			return 'Price cannot be higher than' . $max;
		}else{
			return '';
		}
	}

    // for validating the quantity
	function quantity($data, $min, $max){
		global $errors;

		if(is_float($data) == true){
			$errors['error_count'] = true;
			return 'Quantity cannot be a decimal';
		}else if($data > $max || $data < $min){
			$errors['error_count'] = true;
			return 'Quantity must be between ' . $min . ' and ' . $max;
		}else{
			return '';
		}
	}
}

?>