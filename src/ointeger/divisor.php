<?php namespace estvoyage\risingsun\ointeger;

use
	estvoyage\risingsun
;

class divisor extends risingsun\ointeger
{
	function __construct($value)
	{
		$exception = null;

		try
		{
			parent::__construct($value);
		}
		catch (\exception $exception) {}

		if ($exception || ! $value)
		{
			throw new \domainException('Divisor should be an integer not equal to 0');
		}
	}
}
