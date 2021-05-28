<?php

namespace util;

class TelegramBot
{
	private $url = "https://api.telegram.org/bot1098401798:AAEycvrpsUUIUb0oOcUO-_tGsvlfJEK8dVg/sendMessage?chat_id=@";
	private $group;
	private $message;
	
	public function __construct($group)
	{
		$this->group = $group;
	}
	
	public function getGroup()
	{
		return $this->group;
	}
	
	public function setGroup($group)
	{
		$this->group = $group;
	}
	
	public function getMessage()
	{
		return $this->message;
	}
	
	public function setMessage($message)
	{
		$this->message = $message;
	}
	
	public function addMessage($message)
	{
		$this->message .= $message . "\n";
	}
	
	public function send()
	{
		$completeURL = $this->url . $this->group . "&text=" . urlencode($this->message);
		file_get_contents($completeURL);
	}
}