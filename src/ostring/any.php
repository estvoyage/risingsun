<?php namespace estvoyage\risingsun\ostring;

use estvoyage\risingsun\{ nstring, ostring, datum, oboolean, ointeger };

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

	function recipientOfDatumOperationIs(datum\operation\unary $operation, datum\recipient $recipient)
	{
		$operation
			->recipientOfDatumOperationWithDatumIs(
				$this,
				$recipient
			)
		;

		return $this;
	}

	function recipientOfDatumLengthComparisonIs(datum\length\comparison $comparison, oboolean\recipient $recipient)
	{
		$comparison
			->recipientOfDatumLengthComparisonWithDatumLengthIs(
				new ointeger\unsigned\any(strlen($this->value)),
				$recipient
			)
		;

		return $this;
	}
}
