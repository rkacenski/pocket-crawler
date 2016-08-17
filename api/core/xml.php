<?php

Class Xml
{
	
	private $xpage = 1;
	private $last_update;
	private $feedme = true;
	private $content = [];
	
	public function find_xml($url) {
		if($file_string = @file_get_contents($url.$this->xpage)) {
			$file_string = stripslashes($file_string);
			$file_string = htmlspecialchars($file_string, ENT_XML1, 'UTF-8');
			if($xml = new SimpleXMLElement($file_string)) {
				return $xml;
			}
		}
	}
	
	public function get_xml($url, $time){
		$this->last_update = $time;
		
		while($this->feedme) {
			$xdata = $this->find_xml($url);
			$this->content = array_merge($this->content, $this->prase($xdata));
			$this->xpage++;
		}
		
		return $this->content;
	}
	
	public function test_xml($url){
		
			$xdata = $this->find_xml($url);
			
			$test = $xdata->channel->item;
			
			return array(
					'title' => $test->title,
					'url' => $test->link,
					'html' => trim($test->description)
				);
	}
	
	public function prase($xdata) {
		$new = [];
		
		foreach($xdata->channel->item as $art) {
			if(strtotime($art->pubDate) > $this->last_update){
				$new[] = array(
					'title' => $art->title,
					'url' => $art->link
				);
			} else {
				$this->feedme = false;
				break;
			}
		}
		
		return $new;
	}
	
	public function par($xdata) {
		foreach($xdata->channel->item as $art) {
			print_r($art);
		}
			die();
	}
	
	
}