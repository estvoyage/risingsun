<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum\operation, datum, nstring, nstring\recipient\functor };

class any
	implements
		operation\binary
{
	private
		$template,
		$operation
	;

	function __construct(datum $template, nstring\operation\binary $operation)
	{
		$this->template = $template;
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
									function($secondOperandValue) use ($firstOperandValue, $recipient)
									{
										$this->operation
											->recipientOfOperationOnNStringsIs(
												$firstOperandValue,
												$secondOperandValue,
												new functor(
													function($operation) use ($recipient)
													{
														$this->template
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
