<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, block\functor };

class addition
	implements
		operation\unary
{
	private
		$suffix
	;

	function __construct(datum $suffix)
	{
		$this->suffix = $suffix;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		(new operation\binary\addition)
			->recipientOfDatumOperationOnDataIs(
				$datum,
				$this->suffix,
				$recipient
			)
		;

		return $this;
	}
}
