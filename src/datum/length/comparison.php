<?php namespace estvoyage\risingsun\datum\length;

use estvoyage\risingsun\{ ointeger, oboolean };

interface comparison
{
	function recipientOfDatumLengthComparisonWithDatumLengthIs(ointeger\unsigned $length, oboolean\recipient $recipient);
}
