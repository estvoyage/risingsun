<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\datum;

class any
	implements
		datum\operation\unary
{
	private
		$operand,
		$operation
	;

	function __construct(datum $operand, datum\operation\binary $operation)
	{
		$this->operand = $operand;
		$this->operation = $operation;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$this->operation
			->recipientOfDatumOperationOnDataIs(
				$datum,
				$this->operand,
				$recipient
			)
		;
	}
}
