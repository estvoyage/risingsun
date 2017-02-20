<?php namespace estvoyage\risingsun\datum;

use estvoyage\risingsun\{ datum, nstring };

interface operation
{
	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, nstring\recipient $recipient);
}
