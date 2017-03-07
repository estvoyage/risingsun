<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block, block\functor, comparison };

class greaterThanOrEqualTo
	implements
		ointeger\comparison\binary
{
	private
		$ok,
		$ko
	;

	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		$this->ok = $ok ?: new oboolean\ok;
		$this->ko = $ko ?: new oboolean\ko;
	}

	function recipientOfOIntegerComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient)
	{
		$firstOperand
			->recipientOfNIntegerIs(
				new functor(
					function($firstOperandValue) use ($secondOperand, $recipient) {
						$secondOperand
							->recipientOfNIntegerIs(
								new functor(
									function($secondOperandValue) use ($firstOperandValue, $recipient) {
										(new comparison\binary\greaterThanOrEqualTo($this->ok, $this->ko))
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
