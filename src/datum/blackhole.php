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

	function recipientOfDatumFromDatumIs(datum $datum, datum\recipient $recipient) :void
	{
	}
}
