<?php

namespace Configuration;

abstract class Configuration
{
	public static function getFromJSON($key)
	{
		$returnValue = null;
		$jsonPath = __DIR__ . "/connection.json";
		$jsonValues = json_decode(file_get_contents($jsonPath), true);
		if (key_exists($key, $jsonValues)) {
			$returnValue = $jsonValues[$key];
		}
		return $returnValue;
	}
}