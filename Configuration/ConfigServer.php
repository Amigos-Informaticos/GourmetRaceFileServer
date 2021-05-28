<?php

namespace Configuration;

class ConfigServer
{
	private $clientName;
	private $curl;
	
	public function __construct($clientName)
	{
		$this->clientName = $clientName;
		$this->curl = curl_init();
	}
	
	public function get($key)
	{
		$url = Configuration::getFromJSON("configServerURL");
		return file_get_contents($url);
	}
	
	public function getMany($keys)
	{
		$url = Configuration::getFromJSON("configServerURL");
		$url .= "/" . $this->clientName;
		$options = array(
			"http" => array(
				"header" =>
					"Content-Type: application/json\r\n" .
					"Accept: application/json\r\n",
				"method" => "PATCH",
				"content" => json_encode($keys)
			));
		$context = stream_context_create($options);
		return json_decode(file_get_contents($url, false, $context));
	}
}