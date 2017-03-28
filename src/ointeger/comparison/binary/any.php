<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, comparison\binary as comparison, ninteger\recipient\functor };

class any
	implements
		ointeger\comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfOIntegerComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient)
	{
		$firstOperand
			->recipientOfNIntegerIs(
				new functor(
					function($firstOperandValue) use ($secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfNIntegerIs(
								new functor(
									function($secondOperandValue) use ($firstOperandValue, $recipient)
									{
										$this->comparison
											->recipientOfComparisonBetweenValuesIs(
												$firstOperandValue,
												$secondOperandValue,
												$recipient
											)
										;
									}
								)
							)
						;
					}
				)
			)
		;

		return $this;
	}
}
