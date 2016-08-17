<?php

	class Auth
	{
		public function __construct()
		{
			header('Access-Control-Allow-Origin: *');
			$this->db = new Database();
			$this->setup();
		}
		
		public function setup()
		{
				
				if(isset($_POST['token'])) {
					//$_SESSION['user_id'] = $_POST['user_id'];
					$this->db->connect();
					//seterize below
					$token = $_POST['token'];
					$user_id = $_POST['user_id'];
					
					$this->db->insert('tokens', array('token'=>$token));
					
					$url  = 'http://beta.linkvehicle.com/asynchronous/api_auth';
					$curl = curl_init();
					// Set some options - we are passing in a useragent too here
					curl_setopt_array($curl, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL => $url,
					    CURLOPT_USERAGENT => 'linkvehicle',
					    CURLOPT_POST => 1,
					    CURLOPT_POSTFIELDS => array('token' => $token)
					));
					// Send the request & save response to $resp
					$resp = curl_exec($curl);
					$resp = json_decode($resp);
					
					if($resp->token_valid) {
						echo 'ya';
						$_SESSION['user_id'] = $user_id;
					} else
						echo 'adad';
					// Close request to clear up some resources
					curl_close($curl);
				} else 
					echo 'nah';
		}
	}