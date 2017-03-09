<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, nstring, oboolean };

class blackhole
	implements
		datum
{
	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		return $this;
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		return $this;
	}

	function recipientOfDatumOperationWithDatumIs(datum\operation\binary $operation, datum $datum, datum\recipient $recipient)
	{
		return $this;
	}

	function recipientOfDatumOperationIs(datum\operation\unary $operation, datum\recipient $recipient)
	{
		return $this;
	}

	function recipientOfDatumLengthComparisonIs(datum\length\comparison $comparison, oboolean\recipient $recipient)
	{
		return $this;
	}
}
