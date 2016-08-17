<?php

class Route 
{
	
	private $_uri = array();
	private $_method = array();
	
	/**
	* Builds URI collection
	* @param type $url
	*/
	public function add($uri, $method = null, $auth = false)
	{
		$this->_uri[] = trim($uri, '/');
		
		if($method != null) {
			$this->_method[] = $method;
		}
		
		if($auth)
			$this->_auth_check();
	}
	
	function _auth_check()
	{
		header('Access-Control-Allow-Origin: *');
		
		if($_SERVER['REMOTE_ADDR'] == LINK_SERVER)
			return true;
		
		if(isset($_POST['token'])) {
			$token = $_POST['token'];
			$user_id = $_POST['user_id'];
			
			$url  = 'http://beta.linkvehicle.com/asynchronous/api_auth';
			$curl = curl_init();
		
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $url,
			    CURLOPT_USERAGENT => 'linkvehicle',
			    CURLOPT_POST => 1,
			    CURLOPT_POSTFIELDS => array('token' => $token)
			));
			
			$resp = curl_exec($curl);
			curl_close($curl);
			
			$resp = json_decode($resp);
			
			if($resp->token_valid)
				return true;
			else
				die(json_encode(array('error' => 'No Auth')));
			
		} else 
			die(json_encode(array('error' => 'No Auth')));
	}
	
	public function run()
	{
		$uriparam = isset($_GET['uri']) ? explode('/', $_GET['uri']) : '/';

		if($uriparam[0] == '/') $this->_uri[0] = '/';
		
		foreach ($this->_uri as $key => $value)
		{
			if(preg_match("#^$value$#", $uriparam[0]))
			{
				if(is_string($this->_method[$key]))
				{
					$method = $this->_method[$key];
					if($value == '/') $value = strtolower($method);
					include 'routes/'.$value.'.php';
					$method = new $method();
					if(isset($uriparam[1]) && is_string($uriparam[1]))
					{
						call_user_func(array($method, $uriparam[1]));
					} 
					else
					{
						call_user_func(array($method, 'index'));
					}
				} 
				else
				{
					call_user_func($this->_method[$key]);
				}	
			}
		}
	}
}