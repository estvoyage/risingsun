<?php namespace estvoyage\risingsun\ofloat;

use
	estvoyage\risingsun
;

abstract class unsigned extends risingsun\ofloat
{
	function __construct($value = 0.)
	{
		$domainException = null;

		try
		{
			parent::__construct($value);
		}
		catch (\domainException $domainException) {}

		if ($domainException || self::isLessThanZero($value))
		{
			throw new \domainException('Value should be a float greater than or equal to 0');
		}
	}

	private static function isLessThanZero($value)
	{
		return $value < 0.;
	}
}
