<?php namespace estvoyage\risingsun\datum\operation;

use estvoyage\risingsun\{ datum, nstring };

interface unary
{
	function recipientOfOperationWithDatumIs(datum $datum, nstring\recipient $recipient);
}
