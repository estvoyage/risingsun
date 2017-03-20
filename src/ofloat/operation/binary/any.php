<?php namespace estvoyage\risingsun\ofloat\operation\binary;

use estvoyage\risingsun\{ ofloat\operation, ofloat, nfloat, block\functor };

class any
	implements
		operation\binary
{
	private
		$operation
	;

	function __construct(nfloat\operation\binary $operation)
	{
		$this->operation = $operation;
	}

	function recipientOfOperationOnOFloatsIs(ofloat $firstOperand, ofloat $secondOperand, ofloat\recipient $recipient)
	{
		$firstOperand
			->recipientOfNFloatIs(
				new functor(
					function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfNFloatIs(
								new functor(
									function($secondOperandValue) use ($firstOperand, $firstOperandValue, $recipient)
									{
										$this->operation
											->recipientOfOperationOnNFloatsIs(
												$firstOperandValue,
												$secondOperandValue,
												new functor(
													function($operationValue) use ($firstOperand, $recipient)
													{
														$firstOperand
															->recipientOfOFloatWithNFloatIs(
																$operationValue,
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
					}
				)
			)
		;

		return $this;
	}
}
