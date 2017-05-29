<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, ointeger };

interface length
{
	function recipientOfLengthOfDatumIs(datum $datum, ointeger\recipient $recipient) :void;
}
