<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, nstring };

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

	function recipientOfDatumLengthIs(datum\length\recipient $recipient)
	{
		return $this;
	}
}
