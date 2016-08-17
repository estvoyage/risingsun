<?php namespace estvoyage\risingsun\ointeger\divisor;

use
	estvoyage\risingsun
;

class unsigned extends risingsun\ointeger\divisor
{
	function __construct($value)
	{
		$exception = null;

		try
		{
			parent::__construct($value);
		}
		catch (\exception $exception) {}

		if ($exception || $value < 0)
		{
			throw new \domainException('Unsigned divisor must be an integer greater than 0');
		}
	}
}
