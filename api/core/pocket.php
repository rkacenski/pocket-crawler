<?php
Class Pocket {
	
	private $consumer_key = '57210-3e84faf8d8558003141c4ce1';
	private $redirect_uri = '/linky/api/index.php?uri=linky/callback';
	private $access_token = '7b5752b0-5b1a-6cfe-05b9-c7899e';
	
	
	public function connect(){
		$url = 'https://getpocket.com/v3/oauth/request';
		$redirect = 'http://'.$_SERVER['HTTP_HOST'].$this->redirect_uri;
		
		$data = array(
			'consumer_key' => $this->consumer_key, 
			'redirect_uri' => $redirect
		);
		$options = array(
			'http' => array(
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		// our $result contains our request token
		$code = explode('=',$result);
		$request_token = $code[1];

		// now we need to redirect the user to pocket
		header("Location: https://getpocket.com/auth/authorize?request_token=$request_token&redirect_uri=$redirect?request_token=$request_token");
	}
	
	public function callback() {
		$request_token = $_GET['request_token'];
		$url = 'https://getpocket.com/v3/oauth/authorize';
		$data = array(
			'consumer_key' => $this->consumer_key, 
			'code' => $request_token
		);
		$options = array(
			'http' => array(
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		// our $result contains our access token

		$access_token = explode('&',$result);
		if($access_token[0]!=''){
			echo "<h1>You've been authenticated succesfully!</h1>";
			echo "You should write down the access_token and then add it to config.php<br>";
			echo "Your access token: ". $access_token[0];
			echo "<br>";
			echo "add this to config.php";
		} else{
			echo "Something went wrong. :( ";
		}
	}
	/*
	public function add($art){
		$url = 'https://getpocket.com/v3/add';
			$data = array(
				'url' => $art,
				'tags' => 'linky',
				'consumer_key' => $this->consumer_key, 
				'access_token' => $this->access_token
			);
			$options = array(
				'http' => array(
					
					'method'  => 'POST',
					'content' => http_build_query($data)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			var_dump($result);
			
	}
	*/
	public function add($art){
		$url = 'https://getpocket.com/v3/add';
			$data = array(
				'url' => $art,
				'consumer_key' => $this->consumer_key, 
				'access_token' => $this->access_token
			);
			$data = json_encode($data);
			//echo $data;
			$options = array(
				'http' => array(
					'header' => "Connection: close\r\n".
								"Content-Type: application/json; charset=UTF-8\r\n".
								"Content-Length: ".strlen($data)."\r\n",
					'method'  => 'POST',
					'content' => $data 
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			var_dump($context);
			var_dump($result);
			var_dump($http_response_header);
	}
	
}
?>