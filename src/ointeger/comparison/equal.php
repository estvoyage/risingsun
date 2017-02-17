<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, ointeger\comparison, oboolean, block\functor, block };

class equal
	implements
		comparison
{
	private
		$oboolean
	;

	function __construct(oboolean $oboolean = null)
	{
		$this->oboolean = $oboolean ?: new oboolean\ok;
	}

	function recipientOfComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient)
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
										$this->oboolean
											->recipientOfOBooleanWithValueIs(
												$firstOperandValue == $secondOperandValue,
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

	function blockForComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, block $block)
	{
		return $this->recipientOfComparisonBetweenOIntegersIs(
			$firstOperand,
			$secondOperand,
			new functor(
				function($oboolean) use ($block)
				{
					$oboolean->blockForTrueIs($block);
				}
			)
		);
	}
}