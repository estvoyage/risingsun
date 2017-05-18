<?php namespace estvoyage\risingsun\ointeger\unsigned;

use estvoyage\risingsun\{ ointeger, block\error, comparison };

class any extends ointeger\any
	implements
		ointeger\unsigned
{
	function __construct($value = 0)
	{
		try
		{
			parent::__construct($value);

			(new ointeger\comparison\unary\lessThan(new ointeger\any))
				->recipientOfComparisonWithOIntegerIs(
					$this,
					new comparison\recipient\ok(
						new error
						(
							new \typeError
						)
					)
				)
			;
		}
		catch (\typeError $error)
		{
			throw new \typeError('Value should be an unsigned integer');
		}
	}
}
