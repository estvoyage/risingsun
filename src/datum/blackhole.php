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

	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient)
	{
		return $this;
	}
}
