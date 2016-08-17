<?php

	class Owl
	{
		public function __construct()
		{
			$this->db = new Database();
			$this->help = new Help();
		}
		
		public function read(){
			$this->db->connect();
			$this->db->sql("select * from article order by date desc limit 100");
			
			$res = $this->db->getResult();
			if(isset($res[0]))
				$this->help->json_out($res);
			else 
				$this->help->json_out(array('no_article'=>true));
		}
		
	}