<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\{ datum, nstring };

interface binary
{
	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, nstring\recipient $recipient);
}
