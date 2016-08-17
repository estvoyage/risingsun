<?php namespace estvoyage\risingsun\ostring;

use
	estvoyage\risingsun
;

class notEmpty extends risingsun\ostring
{
	function __construct($value)
	{
		$domainException = null;

		try
		{
			parent::__construct($value);
		}
		catch (\domainException $domainException) {}

		if ($domainException || self::isEmpty($value))
		{
			throw new \domainException('Value should be a not empty string');
		}
	}

	private static function isEmpty($value)
	{
		return $value == '';
	}
}
