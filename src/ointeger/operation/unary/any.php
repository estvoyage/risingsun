<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\ointeger;

class any
	implements
		ointeger\operation\unary
{
	private
		$secondOperand,
		$operation
	;

	function __construct(ointeger $secondOperand, ointeger\operation\binary $operation)
	{
		$this->secondOperand = $secondOperand;
		$this->operation = $operation;
	}

	function recipientOfOperationWithOIntegerIs(ointeger $firstOperand, ointeger\recipient $recipient)
	{
		$this->operation
			->recipientOfOperationOnOIntegersIs(
				$firstOperand,
				$this->secondOperand,
				$recipient
			)
		;

		return $this;
	}
}
