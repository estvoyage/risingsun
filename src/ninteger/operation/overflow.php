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
		(new comparison\unary\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\ok(
					new block\functor(
						function() use ($value, $recipient)
						{
							(new comparison\unary\with\ninteger\type)
								->recipientOfComparisonWithOperandIs(
									$value,
									new comparison\recipient\switcher(
										new block\functor(
											function() use ($value, $recipient)
											{
												$recipient->nintegerIs($value);
											}
										),
										new block\functor(
											function() use ($value, $recipient)
											{
												(new comparison\unary\with\true\boolean)
													->recipientOfComparisonWithOperandIs(
														(string) $value > PHP_INT_MAX || (string) $value < PHP_INT_MIN,
														new comparison\recipient\ok(
															$this->block
														)
													)
												;
											}
										)
									)
								)
							;
						}
					)
				)
			)
		;

		return $this;
	}
}
