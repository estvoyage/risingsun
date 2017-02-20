<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, nstring, block\functor };

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

	function recipientOfOperationWithDatumIs(datum $datum, nstring\recipient $recipient)
	{
		(new operation\binary\addition)
			->recipientOfOperationOnDataIs(
				$datum,
				$this->suffix,
				$recipient
			)
		;

		return $this;
	}
}
