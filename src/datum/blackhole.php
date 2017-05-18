<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, nstring };

class blackhole
	implements
		datum
{
	function recipientOfNStringIs(nstring\recipient $recipient) :void
	{
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient) :void
	{
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient) :void
	{
	}
}
