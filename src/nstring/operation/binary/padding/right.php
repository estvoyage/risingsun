<?php namespace estvoyage\risingsun\nstring\operation\binary\padding;

use estvoyage\risingsun\{ nstring, ointeger, ninteger, comparison, block };

class right
	implements
		nstring\operation\binary
{
	private
		$length
	;

	function __construct(ointeger\unsigned $length)
	{
		$this->length = $length;
	}

	function recipientOfOperationOnNStringsIs(string $firstOperand, string $secondOperand, nstring\recipient $recipient)
	{
		$this->length
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($length) use ($firstOperand, $secondOperand, $recipient)
					{
						(
							new comparison\unary\not\blank(
								new block\functor(
									function() use ($recipient, $firstOperand, $length, $secondOperand)
									{
										$recipient->nstringIs(
											str_pad(
												$firstOperand,
												$length,
												$secondOperand
											)
										);
									}
								)
							)
						)
							->operandForComparisonIs($secondOperand)
						;
					}
				)
			)
		;

		return $this;
	}
}
