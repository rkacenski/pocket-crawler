<?php

	class Linky
	{
		public function __construct()
		{
			
			$this->db = new Database();
			$this->xml = new Xml();
			$this->pocket = new Pocket();
			//$this->test();
		}
		
		public function index(){
			echo 'hello';
		}
		
		public function connect(){
			$this->pocket->connect();
		}
		
		public function callback(){
			$this->pocket->callback();
		}
		
		public function crawl(){
			if(!$this->db->connect()) 
				die('connect fail');
			$this->db->sql("select * from source order by last_update limit 10");
			$source = $this->db->getResult();
			
			
			foreach($source as $feed) {
				if($feed['xml']) {
					$x = $this->xml->get_xml($feed['feed'], $feed['last_update']);
					//$x = $this->xml->get_xml("http://www.suasnews.com/feed/?paged=", 1470268800);
				
					foreach($x as $art) {
						if(isset($art['url'])) {
							$this->pocket->add(utf8_encode($art['url']));
							echo utf8_encode($art['url']);
						}
					}
				} else {
					include_once('core/linky.php');
					$page = 1;
					$more = true;
					$x = array();
					while($more) {
						$data = blogx($feed['feed'].$page, $feed['last_update'], $feed['artx'], $feed['timex']);
						if(!end($data))
							$more = false;
						$x = array_merge($x, $data);
						$page++;
					}
					
					foreach($x as $art) {
						if(isset($art['url'])) {
							$this->pocket->add(utf8_encode($art['url']));
							echo utf8_encode($art['url']);
						}
					}
				}
				echo $feed['feed'] . $feed['last_update'];
				$this->db->update('source', array('last_update'=>time()), 'id='.$feed['id']);
			}
		}
		
		public function add($art){
			//$art = 'http://www.suasnews.com/2016/08/propeller-hiring-experienced-marketer-full-stack-developer-web-designer/';
			$this->pocket->add($art);
		}
		
		public function test() {
			if(!$this->db->connect()) 
				die('connect fail');
			$this->db->sql("select * from source order by last_update limit 10");
			$source = $this->db->getResult();
			
			
			foreach($source as $feed) {
				if(!$feed['xml']) {
					include_once('core/linky.php');
					$page = 1;
					$more = true;
					$art = array();
					while($more) {
						$data = blogx($feed['feed'].$page, 1469546144, $feed['artx'], $feed['timex']);
						if(!end($data))
							$more = false;
						$art = array_merge($art, $data);
						$page++;
					}
					print_r($art);
				}
			}
		}
		
	}