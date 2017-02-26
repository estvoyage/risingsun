<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, oboolean, block, block\functor, comparison };

class greaterThanOrEqualTo
	implements
		ointeger\comparison\binary
{
	private
		$oboolean
	;

	function __construct(oboolean $oboolean = null)
	{
		$this->oboolean = $oboolean ?: new oboolean\ok;
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
										(new comparison\greaterThanOrEqualTo($firstOperandValue, $secondOperandValue, $this->oboolean))
											->recipientOfComparisonIs($recipient)
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