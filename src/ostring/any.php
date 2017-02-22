<?php namespace estvoyage\risingsun\ostring;

use estvoyage\risingsun\{ nstring, ostring, datum };

class any
	implements
		ostring
{
	private
		$value
	;

	function __construct($value = '')
	{
		$this->value = (string) $value;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs($this->value);
	}

	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient)
	{
		$datum = clone $this;
		$datum->value = $value;

		$recipient->datumIs($datum);

		return $this;
	}

	function recipientOfDatumOperationWithDatumIs(datum\operation\binary $operation, datum $datum, datum\recipient $recipient)
	{
		$operation
			->recipientOfDatumOperationOnDataIs(
				$this,
				$datum,
				$recipient
			)
		;

		return $this;
	}
}
