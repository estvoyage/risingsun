<?php namespace estvoyage\risingsun\ointeger;

use
	estvoyage\risingsun
;

class unsigned extends risingsun\ointeger
{
	function __construct($value = 0)
	{
		$domainException = null;

		try
		{
			parent::__construct($value);
		}
		catch (\domainException $domainException) {}

		if ($domainException || ! self::isUnsigned($value))
		{
			throw new \domainException('Value should be an integer greater than or equal to 0');
		}
	}

	private static function isUnsigned($value)
	{
		return $value >= 0;
	}
}
