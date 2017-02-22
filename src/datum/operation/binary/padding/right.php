<?php namespace estvoyage\risingsun\datum\operation\binary\padding;

use estvoyage\risingsun\{ datum\operation, datum, ointeger, block\functor };

class right
	implements
		operation\binary
{
	private
		$length
	;

	function __construct(ointeger\unsigned $length)
	{
		$this->length = $length;
	}

	function recipientOfDatumOperationOnDataIs(datum $firstOperand, datum $secondOperand, datum\recipient $recipient)
	{
		$this->length
			->recipientOfNIntegerIs(
				new functor(
					function($lengthValue) use ($firstOperand, $secondOperand, $recipient)
					{
						$firstOperand
							->recipientOfNStringIs(
								new functor(
									function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient, $lengthValue)
									{
										$secondOperand
											->recipientOfNStringIs(
												new functor(
													function($secondOperandValue) use ($firstOperand, $recipient, $lengthValue, $firstOperandValue)
													{
														if ($secondOperandValue != '')
														{
															$firstOperand
																->recipientOfDatumWithValueIs(
																	str_pad($firstOperandValue, $lengthValue, $secondOperandValue),
																	$recipient
																)
															;
														}
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
