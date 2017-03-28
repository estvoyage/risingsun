<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\datum;

interface converter
{
	function recipientOfDatumIs(datum $datum, datum\recipient $recipient);
}
