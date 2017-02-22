<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\{ datum };

interface unary
{
	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient);
}
