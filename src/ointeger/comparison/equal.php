<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, ointeger\comparison, oboolean, block\functor, block };

class equal
	implements
		comparison\binary
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

	function blockForOIntegerComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, block $block)
	{
		return $this->recipientOfOIntegerComparisonBetweenOIntegersIs(
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
