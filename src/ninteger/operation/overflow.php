<?php namespace estvoyage\risingsun\ninteger\operation;

use estvoyage\risingsun\{ block, ninteger, comparison };

class overflow
{
	private
		$block
	;

	function __construct(block $block = null)
	{
		$this->block = $block ?: new block\blackhole;
	}

	function valueFromOperationWithNIntegerRecipientIs(ninteger\recipient $recipient, $value)
	{
		(
			new comparison\unary\with\numeric\type(
				new block\functor(
					function() use ($value, $recipient)
					{
						(
							new comparison\unary\with\ninteger\type(
								new block\functor(
									function() use ($value, $recipient)
									{
										$recipient->nintegerIs($value);
									}
								),
								new block\functor(
									function() use ($value, $recipient)
									{
										(
											new comparison\unary\with\true\boolean(
												$this->block
											)
										)
											->operandForComparisonIs((string) $value > PHP_INT_MAX || (string) $value < PHP_INT_MIN)
										;
									}
								)
							)
						)
							->operandForComparisonIs($value)
						;
					}
				)
			)
		)
			->operandForComparisonIs($value)
		;

		return $this;
	}
}
