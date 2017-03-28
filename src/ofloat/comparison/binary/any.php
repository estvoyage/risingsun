<?php namespace estvoyage\risingsun\ofloat\comparison\binary;

use estvoyage\risingsun\{ ofloat, oboolean, comparison, block\functor };

class any
	implements
		ofloat\comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison\binary $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfOFloatComparisonBetweenOFloatsIs(ofloat $firstOperand, ofloat $secondOperand, oboolean\recipient $recipient)
	{
		$firstOperand
			->recipientOfNFloatIs(
				new functor(
					function($firstOperandValue) use ($secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfNFloatIs(
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
