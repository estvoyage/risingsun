<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger\operation, ointeger, ninteger, ninteger\recipient\functor };

class any
	implements
		operation\binary
{
	private
		$operation
	;

	function __construct(ninteger\operation\binary $operation)
	{
		$this->operation = $operation;
	}

	function recipientOfOperationOnOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, ointeger\recipient $recipient)
	{
		$firstOperand->recipientOfNIntegerIs(
			new functor(
				function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient)
				{
					$secondOperand->recipientOfNIntegerIs(
						new functor(
							function($secondOperandValue) use ($firstOperand, $firstOperandValue, $recipient)
							{
								$this->operation
									->recipientOfOperationOnNIntegersIs(
										$firstOperandValue,
										$secondOperandValue,
										new functor(
											function($operation) use ($firstOperand, $recipient)
											{
												$firstOperand->recipientOfOIntegerWithNIntegerIs(
													$operation,
													$recipient
												);
											}
										)
									)
								;
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
