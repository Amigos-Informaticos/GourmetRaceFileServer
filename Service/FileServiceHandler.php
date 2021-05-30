<?php

namespace Service;

use Configuration\ConfigServer;
use fileservice\GalleryServiceIf;

class FileServiceHandler implements GalleryServiceIf
{
	private static $connectionString = "";
	private static $serverURL = "";
	private static $dirPath = "";
	private static $ftpUser = "";
	private static $ftpPass = "";
	
	public function __construct()
	{
		if (FileServiceHandler::$connectionString == "") {
			$configServer = new ConfigServer("gourmetRace");
			$requiredValues = ["ftpConnection", "ftpPath", "ftpUser", "ftpPass", "db_host"];
			$results = $configServer->getMany($requiredValues);
			FileServiceHandler::$connectionString = $results->ftpConnection;
			FileServiceHandler::$dirPath = $results->ftpPath;
			FileServiceHandler::$ftpUser = $results->ftpUser;
			FileServiceHandler::$ftpPass = $results->ftpPass;
			FileServiceHandler::$serverURL = $results->db_host;
		}
	}
	
	public function saveFiles(array $images)
	{
		foreach ($images as $tmpImage) {
			$path = FileServiceHandler::$connectionString . FileServiceHandler::$dirPath;
			file_put_contents(
				$path . $tmpImage->path,
				$tmpImage->file
			);
		}
		return 1;
	}
	
	public function getFiles(array $paths)
	{
		$files = array();
		$index = 0;
		foreach ($paths as $path) {
			$fullPath = FileServiceHandler::$connectionString . FileServiceHandler::$dirPath . $path;
			$files[$index] = file_get_contents($fullPath);
			$index++;
			echo "Got";
		}
		return $files;
	}
	
	public function deleteFiles(array $paths)
	{
		$connection = ftp_connect(FileServiceHandler::$serverURL);
		ftp_login($connection, self::$ftpUser, self::$ftpPass);
		foreach ($paths as $path) {
			ftp_delete(
				$connection,
				FileServiceHandler::$dirPath . $path
			);
		}
		return 1;
	}
}