<?php namespace estvoyage\risingsun\nstring\operation\binary\padding;

use estvoyage\risingsun\{ nstring, ointeger, block\functor };

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
				new functor(
					function($length) use ($firstOperand, $secondOperand, $recipient)
					{
						if ($secondOperand != '')
						{
							$recipient->nstringIs(
								str_pad(
									$firstOperand,
									$length,
									$secondOperand
								)
							);
						}
					}
				)
			)
		;

		return $this;
	}
}
