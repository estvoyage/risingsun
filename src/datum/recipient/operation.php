<?php namespace estvoyage\risingsun\datum\recipient;

use estvoyage\risingsun\datum;

class operation
	implements
		datum\recipient
{
	private
		$operation,
		$recipient
	;

	function __construct(datum\operation\unary $operation, datum\recipient $recipient)
	{
		$this->operation = $operation;
		$this->recipient = $recipient;
	}

	function datumIs(datum $datum)
	{
		$this->operation
			->recipientOfDatumOperationWithDatumIs(
				$datum,
				$this->recipient
			)
		;
	}
}
