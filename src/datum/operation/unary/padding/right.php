<?php namespace estvoyage\risingsun\datum\operation\unary\padding;

use estvoyage\risingsun\{ datum\operation, datum, ointeger };

class right
	implements
		operation\unary
{
	private
		$length,
		$padding
	;

	function __construct(ointeger\unsigned $length, datum $padding)
	{
		$this->length = $length;
		$this->padding = $padding;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		(new operation\binary\padding\right($this->length))
			->recipientOfDatumOperationOnDataIs(
				$datum,
				$this->padding,
				$recipient
			)
		;

		return $this;
	}
}
