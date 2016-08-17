<?php

Class Help
{
	public function auth_check($get_token = false, $beta = false)
	{
		header('Access-Control-Allow-Origin: *');
		
		$token = ($get_token ? $_GET['token'] : $_POST['token']);
		
		if($token) {
			
			
		} else 
			return false;
	}
	
	public function posted($val = null)
	{
		if(isset($val) && isset($_POST[$val])) {
			$post = $_POST[$val];
			if(isset($post[0]['name']) && isset($post[0]['value'])) {
				$array = array();
				foreach ($post as $key => $val)
					$array[$val['name']] = $val['value'];
				return $array;
			} else 
				return $_POST[$val];
		} else if(isset($val) && !isset($_POST[$val])) {
			return false;
		}
		
		$array = array();
		foreach ($_POST as $key => $val)
			$array[$key] = $val;
		return $array;
	}
	
	public function view($view, $vars = null)
	{
		
		$path = 'views/'.$view.'.php';
		
		if (file_exists($path) == false)
		{
			throw new Exception('Template not found in '. $path);
			return false;
		}
		if($vars)
		{
			foreach ($vars as $key => $value)
				$$key = $value;
		}
		
		
		include $path;
	}
	
	
	public function json_out($data){
		echo json_encode($data);
	}
}