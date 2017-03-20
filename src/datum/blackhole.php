<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, nstring, ointeger };

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

	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient)
	{
		return $this;
	}
}
