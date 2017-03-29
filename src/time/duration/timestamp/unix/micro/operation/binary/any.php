<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro as timestamp, nfloat };

class any
	implements
		timestamp\operation\binary
{
	private
		$operation
	;

	function __construct(nfloat\operation\binary $operation)
	{
		$this->operation = $operation;
	}

	function recipientOfOperationOnMicroUnixTimestampsIs(timestamp $firstOperand, timestamp $secondOperand, timestamp\recipient $recipient)
	{
		$firstOperand
			->recipientOfNFloatIs(
				new nfloat\recipient\functor(
					function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfNFloatIs(
								new nfloat\recipient\functor(
									function($secondOperandValue) use ($firstOperand, $firstOperandValue, $recipient)
									{
										$this->operation
											->recipientOfOperationOnNFloatsIs(
												$firstOperandValue,
												$secondOperandValue,
												new nfloat\recipient\functor(
													function($operationValue) use ($firstOperand, $recipient)
													{
														$firstOperand
															->recipientOfMicroUnixTimestampWithNFloatIs(
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
