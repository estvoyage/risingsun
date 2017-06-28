<?php namespace estvoyage\risingsun\ninteger\filter;

use estvoyage\risingsun\{ ninteger, comparison, block };

class type
	implements
		ninteger\filter
{
	private
		$block
	;

	function __construct(block $block = null)
	{
		$this->block = $block ?: new block\blackhole;
	}

	function nIntegerRecipientForValueIs($value, ninteger\recipient $recipient) :void
	{
		(new comparison\unary\with\ninteger\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\switcher(
					new block\functor(
						function() use ($recipient, $value)
						{
							$recipient->nintegerIs($value);
						}
					),
					$this->block
				)
			)
		;
	}
}
