<?php

namespace util;

use Configuration\Configuration;
use R;

abstract class ConnectionBuilder
{
	public static function buildDBConnection()
	{
		if (!R::testConnection()) {
			$database = Configuration::getFromJSON("database");
			$password = Configuration::getFromJSON("password");
			$host = Configuration::getFromJSON("databaseHost");
			$user = Configuration::getFromJSON("user");
			R::setup(
				"mysql:host=$host;dbname=$database",
				$user,
				$password
			);
		}
	}
}