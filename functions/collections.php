<?php

class Collection
{
	//this is to hold data
	public $data = array();
	
	//function for adding an object into the array
	public function add($key, $value)
	{
		$this->data[$key] = $value;
	}

    // function for removing the object from the array
	public function remove($key)
	{
		if(isset($this->data[$key]))
			unset($this->data[$key]);
	}

	// grabing the data 
	public function get($key)
	{
		if(isset($this->data[$key]))
			return $this->data[$key];
	}
    
    //return number of elements in the array
	public function count()
	{
		return count($this->data);
	}
}

?>