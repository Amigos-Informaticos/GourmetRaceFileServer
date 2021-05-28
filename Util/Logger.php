<?php

namespace util;

use Exception;
use util\TelegramBot;

class Logger
{
	
	public static function staticLog(Exception $exception)
	{
		$bot = new TelegramBot("W3Log");
		$bot->setMessage($exception->getTraceAsString());
		$bot->send();
	}
}