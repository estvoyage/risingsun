<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\datum;

interface binary
{
	function recipientOfDatumOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient);
}
