<?php

use Configuration\Configuration;
use Service\FileService;

session_start();

require_once "vendor/autoload.php";

define("PROJECT_ROOT", __DIR__);

header('Content-Type', 'application/x-thrift');

if (php_sapi_name() == 'cli') {
	echo "Running\r\n";
}

FileService::run(
	Configuration::getFromJSON("serviceHost"),
	Configuration::getFromJSON("port")
);