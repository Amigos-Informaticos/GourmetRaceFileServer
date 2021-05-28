<?php

namespace Service;

use fileservice\GalleryServiceProcessor;
use ServiceRunner;

class FileService
{
	public static function run($host, $port)
	{
		$serviceProcessor = new GalleryServiceProcessor(new FileServiceHandler());
		ServiceRunner::run($serviceProcessor, $host, $port);
	}
}