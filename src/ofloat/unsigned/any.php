<?php namespace estvoyage\risingsun\ofloat\unsigned;

use estvoyage\risingsun\ofloat;

class any extends ofloat\any
	implements
		ofloat\unsigned
{
	function __construct($value)
	{
		try
		{
			parent::__construct($value);
		}
		catch (\typeError $exception)
		{
		}
		finally
		{
			if (isset($exception) || $value < 0)
			{
				throw new \typeError('Value should be an unsigned float');
			}
		}
	}
}
