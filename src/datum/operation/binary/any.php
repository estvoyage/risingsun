<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum\operation, datum, nstring, nstring\recipient\functor };

class any
	implements
		operation\binary
{
	private
		$operation
	;

	function __construct(nstring\operation\binary $operation)
	{
		$this->operation = $operation;
	}

	function recipientOfDatumOperationOnDataIs(datum $firstOperand, datum $secondOperand, datum\recipient $recipient)
	{
		$firstOperand
			->recipientOfNStringIs(
				new functor(
					function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient)
					{
						$secondOperand
							->recipientOfNStringIs(
								new functor(
									function($secondOperandValue) use ($firstOperandValue, $firstOperand, $recipient)
									{
										$this->operation
											->recipientOfOperationOnNStringsIs(
												$firstOperandValue,
												$secondOperandValue,
												new functor(
													function($operation) use ($firstOperand, $recipient)
													{
														$firstOperand
															->recipientOfDatumWithNStringIs(
																$operation,
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
