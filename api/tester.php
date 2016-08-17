<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('America/New_York');


require 'vendor/autoload.php';
use Goutte\Client;

function ruasdn_2k()
{
	$client = new Client();
	
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

	try 
	{
	$crawler = $client->request('GET', 'http://www.suasnews.com/');
	}
	catch (Exception $e) {
	    return 3;
	    if ($e->hasResponse()) {
		echo $e->getResponse() .'yo2';
	    }

	}

	$data = $crawler->filter('a')->each(function ($node) {
		return array('href'=>$node->attr('href'), 'rel'=>$node->attr('rel'), 'text'=>$node->text());
	});
	
	$link = $crawler->selectLink('About')->link();
	$crawler = $client->click($link);
	
	$data2 = $crawler->filter('a')->each(function ($node) {
		return array('href'=>$node->attr('href'), 'rel'=>$node->attr('rel'), 'text'=>$node->text());
	});
	
	return array('data1'=>$data, 'dat2222' =>$data2);
}

//print_r(run_2k());

function feed() {
	$client = new Client();
	
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

	try 
	{
	$crawler = $client->request('GET', 'http://www.suasnews.com/feed/');
	}
	catch (Exception $e) {
	    return 3;
	    if ($e->hasResponse()) {
		echo $e->getResponse() .'yo2';
	    }

	}

	$data = $crawler->filter('item')->each(function ($node, $i) {
		$node->getNode(1)->tagName;
	});
	
	/*
	$data = $crawler->filter('item')->each(function ($node, $i) {
		//if(strtotime($node->filter('pubDate')->text()) > $last_update) {
			return array(
				'title'=>$node->filter('title')->text(), 
				'link'=>$node->filter('link')->text(), 
				'date'=>$node->filter('pubDate')->text(), 
				'description'=>$node->filter('description')->text()
			);
			//}
	});
	*/
	
	var_dump($data);
}


// ==============
// = Good stuff =
// ==============


function blog() {
		
	$client = new Client();

	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

	try 
	{
	$crawler = $client->request('GET', 'http://petapixel.com/');
	}
	catch (Exception $e) {
	    return 3;
	    if ($e->hasResponse()) {
		echo $e->getResponse() .'yo2';
	    }

	}

	$data = $crawler->filter('article')->each(function ($node) {
		return array(
			'date' => $node->filter('time')->attr('datetime'),
			'url' => $node->filter('a')->attr('href'),
		);
	});
	
	print_r($data);
}

function blogx($url, $artx, $timex) {
		
	$client = new Client();

	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);

	try 
	{
	$crawler = $client->request('GET', $url);
	}
	catch (Exception $e) {
	    return 3;
	    if ($e->hasResponse()) {
		echo $e->getResponse() .'yo2';
	    }

	}

	$data = $crawler->filterXPath($artx)->each(function ($node, $i) use ($timex) {
		
		//find date
		$date = $node->filterXPath($timex)->attr('datetime');
		if(!$date)
			$date = $node->filterXPath($timex)->text();
		
		return array(
			'date' => strtotime($date),
			'url' => $node->filter('a')->attr('href'),
		);
	});
	
	print_r($data);
}


//blogx(1, '//html/body/div[1]/div[4]/section/div[3]/div/div/div[1]/article', '//header/div/div[1]/time');
//$feed = 'http://www.interdrone.com/news/page/2';
//blogx($feed, '//html/body/div[2]/div/div/div/div/div/div/div[1]/div[1]/div/div/div/div/div[1]/div', '//div[3]/p[2]');


?>