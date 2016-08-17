<?php

	class Feed
	{
		public function __construct()
		{
			
			$this->db = new Database();
			$this->help = new Help();
			$this->xml = new Xml();
			//$this->test();
		}
		
		public function index() {
			
		}
		
		public function test() {
			if(isset($_POST['feed'])){
				$feed = $this->help->posted('feed');
				
				//$feed = $this->db->escapeString($feed);
				if(isset($feed['xml']) && $feed['xml']) {
					
					$x = $this->xml->test_xml($feed['feed'].'1');
					$x['xml'] = true;
					$this->help->json_out($x);
				} else {
					include_once('core/linky.php');
					$art = test_art($feed['feed'].'1', $feed['artx'], $feed['timex']);
					
					if($art[0])
						$this->help->json_out($art[0]);
					else
						$this->help->json_out(array('error'=>true));
				}
			}
		}
		
		public function add() {
			if(isset($_POST['feed'])){
				$feed = $this->help->posted('feed');
				
				//$feed = $this->db->escapeString($feed);
				
				if(!$this->db->connect()) 
					die('connect fail');
				
				
					$feed['feed'] = $feed['feed'];
					$feed['last_update'] = strtotime($feed['last_update']);
				
					$this->db->insert('source', $feed);
					
					if($this->db->insert_id())
						$this->help->json_out(array('added'=>true));
					else
						$this->help->json_out(array('added'=>false));
					
				
			}
		}
	}