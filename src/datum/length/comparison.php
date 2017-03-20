<?php namespace estvoyage\risingsun\datum\length;

use estvoyage\risingsun\{ ointeger, oboolean, datum };

interface comparison
{
	function recipientOfDatumLengthComparisonWithDatumIs(datum $datum, oboolean\recipient $recipient);
	function recipientOfDatumLengthComparisonWithDatumLengthIs(ointeger\unsigned $length, oboolean\recipient $recipient);
}
