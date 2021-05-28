<?php

namespace Service;

abstract class HTTPStatus
{
	const OK = 200;
	const RESOURCE_CREATED = 201;
	const ACCEPTED = 202;
	const NO_CONTENT = 204;
	const RESET_CONTENT = 205;
	const PARTIAL_CONTENT = 206;
	const MOVED_PERMANENTLY = 301;
	const BAD_REQUEST = 400;
	const UNAUTHORIZED = 401;
	const FORBIDDEN = 403;
	const NOT_FOUND = 404;
	const METHOD_NOT_ALLOWED = 405;
	const NOT_ACCEPTABLE = 406;
	const CONFLICT = 409;
	const UNSUPPORTED_MEDIA_TYPE = 4015;
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;
}