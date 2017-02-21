<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\datum;

interface binary
{
	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient);
}
