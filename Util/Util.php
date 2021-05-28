<?php

namespace util;

abstract class Util
{
	public static function crypt($value, $encryptionLevel = 6)
	{
		if ($encryptionLevel == 1) {
			return sha1($value);
		}
		if ($encryptionLevel % 2 == 0) {
			return md5(sha1(self::crypt($value, $encryptionLevel - 1)));
		}
		return md5(self::crypt($value, $encryptionLevel - 1));
	}
}