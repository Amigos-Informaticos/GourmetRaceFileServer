<?php

use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TServerSocket;
use Thrift\Server\TSimpleServer;

abstract class ServiceRunner
{
	public static function run($serviceProcessor, $host, $port)
	{
		$transportFactory = new TTransportFactory();
		$protocolFactory = new TBinaryProtocolFactory();
		$transport = new TServerSocket($host, $port);
		$server = new TSimpleServer(
			$serviceProcessor,
			$transport,
			$transportFactory,
			$transportFactory,
			$protocolFactory,
			$protocolFactory
		);
		$server->serve();
	}
}