<?php namespace estvoyage\risingsun\ointeger\unsigned;

use estvoyage\risingsun\{ ointeger, block\functor, block\error, oboolean };

class any extends ointeger\any
	implements
		ointeger\unsigned
{
	function __construct($value = 0)
	{
		try
		{
			parent::__construct($value);

			$this->recipientOfNIntegerIs(
				new functor(
					function($value)
					{
						oboolean\factory::isTrue($value < 0)
							->blockForTrueIs(
								new error(new \typeError)
							)
						;
					}
				)
			);
		}
		catch (\typeError $error)
		{
			throw new \typeError('Value should be an unsigned integer');
		}
	}
}
