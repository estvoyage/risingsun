<?php namespace estvoyage\risingsun\http\method\comparison;

use estvoyage\risingsun\{ http\method, oboolean, block\functor };

class equal
	implements
		method\comparison
{
	function recipientOfComparisonBetweenHttpMethodsIs(method $firstOperand, method $secondOperand, oboolean\recipient $recipient)
	{
		$firstOperand
			->recipientOfHttpMethodValueIs(
				new functor(
					function($firstOperandValue) use ($secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfHttpMethodValueIs(
								new functor(
									function($secondOperandValue) use ($firstOperandValue, $recipient)
									{
										$recipient->obooleanIs(oboolean\factory::areIdenticals($firstOperandValue, $secondOperandValue));
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
