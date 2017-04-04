<?php namespace estvoyage\risingsun\ointeger\unsigned;

use estvoyage\risingsun\{ ointeger, block\error };

class any extends ointeger\any
	implements
		ointeger\unsigned
{
	function __construct($value = 0)
	{
		try
		{
			parent::__construct($value);

			(
				new ointeger\comparison\unary\lessThan(
					new error
					(
						new \typeError
					)
				)
			)
				->oIntegerForComparisonIs(
					$this
				)
			;
		}
		catch (\typeError $error)
		{
			throw new \typeError('Value should be an unsigned integer');
		}
	}
}
