<?php

	class Tickets
	{
		public function __construct()
		{
			$this->db = new Database();
			$this->help = new Help();
			$this->hash = '$6$rounds=5000$sdfsalf2dnrjefeio$$bnvwckij$';
			date_default_timezone_set('America/New_York');
			$this->db->connect();
			$this->admin = false;
		}
		
		public function auth(){
			
			if(isset($_POST['token'])) {
				$token = $this->db->escapeString($_POST['token']);
				$id = explode("-", $token);
				$this->db->sql('select * from user where id = '.$id[0]);
				$res = $this->db->getResult();
				
				if($res[0]['token'] == $token) {
					if($res[0]['admin']) {
						$this->admin = true;
						return $id[0];
					} else
						return $id[0];
				} else
					$this->help->json_out(array('error'=>'Bad Auth')); die();
			} else 
				$this->help->json_out(array('error'=>'No Auth')); die();
		}
		
		public function find(){
			$id = $this->auth();
			if($id){
				if($this->admin)
					$this->db->sql('select * from tickets');
				else
					$this->db->sql("select * from tickets where user_id=$id order by id desc");
				
					$res = $this->db->getResult();
					
				if(isset($res[0]))
					$this->help->json_out($res);
				else 
					$this->help->json_out(array('no_tickets'=>true));
			}
		}
		
		public function get(){
			$id = $this->auth();
			$tid = $this->help->posted('tid');
			if($id && $tid){
				
				$tid = $this->db->escapeString($tid);
				$this->db->sql("select * from tickets where id=$tid");
				$res = $this->db->getResult();
				//$res[0]['pname'] = $this->get_name($id);
				$data = $res[0];
				
				$this->db->sql("select * from messages where tid=$tid ");
				$res = $this->db->getResult();
				
				$data['messages'] = $res;
				
				$this->help->json_out($data);
			}
		}
		
		public function create() {
			$id = $this->auth();
			
			if($id && isset($_POST['ticket'])){
				$ticket = $this->help->posted('ticket');
				
				$ticket = $this->db->escapeString($ticket);
				
				$ticket['user_id'] = $id;
				$ticket['status'] = 'unresolved';
				
				
				$name = $this->get_name($id);
				$date = date("d F Y H:i:s", time());
				
				$ticket['last_reply'] = $name;
				$ticket['opened'] = $date;
				$ticket['updated'] = $date;
				
				$this->db->insert('tickets', $ticket);
				$tid = $this->db->insert_id();
				
				$this->db->insert('messages', array('tid'=>$tid, 'name'=>$name, 'date'=>$date, 'message'=>$ticket['problem']));
			
				$this->help->json_out(array('ticket'=>$tid));
			}
			else 
			{
				$this->help->json_out(array('error'=>'Please complete the form'));
			}
				//$res = $this->db->getResult();
				//$this->help->json_out($res);
			
		}
		
		public function add_message(){
			$id = $this->auth();
			$tid = $this->help->posted('tid');
			
			if($id && $tid){
				$data = $this->help->posted();
				unset($data['token']);
				$data = $this->db->escapeString($data);
				
				$data['name'] = $this->get_name($id);
				$data['date'] = date("d F Y H:i:s", time());
				$data['admin'] = $this->admin;
								
				$this->db->insert('messages', $data);
				
				$this->db->update('tickets', array('updated'=>$data['date'],'last_reply' => $data['name']), 'id = '.$tid);
				
				$this->help->json_out(array('success'=>true));
			}
			
		}
		
		public function delete_ticket() {
			$id = $this->auth();
			$tid = $this->help->posted('tid');
			if($id && $tid){
				$this->db->delete('tickets', "id=$tid");
				$this->help->json_out(array('success'=>true));
			}
		}
		
		public function get_name($id){
			$this->db->sql('select * from user where id='.$id);
			$res = $this->db->getResult();
			return $res[0]['firstname'].' '.$res[0]['lastname'];
		}
		
	}