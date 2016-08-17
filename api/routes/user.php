<?php

	class User
	{
		public function __construct()
		{
			$this->db = new Database();
			$this->help = new Help();
			$this->hash = '$6$rounds=5000$sdfsalf2dnrjefeio$$bnvwckij$';
			
			$this->db->connect();
		}
		
		public function login() {
			$login = $this->help->posted();
			
			$login = $this->db->escapeString($login);
			$email =  $login['email'];
			$pass = $login['pass'];

			$this->db->sql("select * from user where email = '$email';");
			$res = $this->db->getResult();
			
			if($res[0]) {
				if($res[0]['pass'] == crypt($pass, $this->hash)) {
					$this->help->json_out(array('token'=>$this->set_token($res[0]['id'])));
				} else {
					$this->help->json_out(array('error'=>'Bad Auth'));
				}
			}
		}
		
		public function signup(){
			$data = $this->help->posted();
			
			$data = $this->db->escapeString($data);
			
			
			if($data['email'] != '' && $data['pass'] != '' && $data['firstname'] != '' && $data['firstname'] != '') {
			
				$data['pass'] = crypt($data['pass'], $this->hash);
			
				$this->db->insert('user', $data);
				$id = $this->db->insert_id();
			
				$this->help->json_out(array('token'=>$this->set_token($id)));
			}
			else 
			{
				$this->help->json_out(array('error'=>'Please complete the form'));
			}
		}
		
		public function set_token($id){
			
			$token = $id.'-'.md5(uniqid($id, true));
			$this->db->update('user', array('token' => $token), 'id = '.$id);
			
			return $token;
		}
		
		public function auth(){
			$token = $_POST['token'];
		
			if($token) {
				$id = explode("-", $token);
				$this->db->sql('select * from user where id = '.$id[0]);
				$res = $this->db->getResult();
				
				if($res[0]['token'] == $token) {
					return true;
				} else
					return false;
			} else 
				return false;
		}
		
	}
	