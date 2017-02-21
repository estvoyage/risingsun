<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\{ datum };

interface unary
{
	function recipientOfOperationWithDatumIs(datum $datum, datum\recipient $recipient);
}
