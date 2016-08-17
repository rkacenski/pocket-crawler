<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('America/New_York');


require 'vendor/autoload.php';
use Goutte\Client;


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

function blogx($url, $last_update, $artx, $timex) {
		
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

	$data = $crawler->filterXPath($artx)->each(function ($node, $i) use ($last_update, $timex) {
		
		//find date
		$date = $node->filterXPath($timex)->attr('datetime');
		if(!$date)
			$date = $node->filterXPath($timex)->text();
		$date =  strtotime($date);
		
		if($date > $last_update) {
			return array(
				'date' => $date,
				'url' => $node->filter('a')->attr('href'),
			);
		}
	});
	
	return $data;
}


function test_art($url, $artx, $timex) {
	$client = new Client();

	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 60);
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_SSL_VERIFYPEER, false);
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_VERBOSE, true);
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_RETURNTRANSFER, true);
	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
	$client->getClient()->setDefaultOption('config/curl/'.CURLOPT_USERAGENT, $agent);

	try 
	{
		$crawler = $client->request('GET', $url);
	}
	catch (Exception $e) {
	    if ($e->hasResponse()) {
			return array('error' => $e->getResponse());
	    }

	}

	$data = $crawler->filterXPath($artx)->each(function ($node, $i) use ($timex) {
		
		//find date
		$date = $node->filterXPath($timex)->attr('datetime');
		if(!$date)
			$date = $node->filterXPath($timex)->text();
		
			return array(
				'date' => $date,
				'url' => $node->filter('a')->attr('href'),
				'html' => $node->html()
			);
	});
	
	return $data;
}

?>