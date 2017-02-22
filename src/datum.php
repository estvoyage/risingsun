<?php namespace estvoyage\risingsun;

interface datum
{
	function recipientOfNStringIs(nstring\recipient $recipient);
	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient);
	function recipientOfDatumOperationWithDatumIs(datum\operation\binary $operation, datum $datum, datum\recipient $recipient);
}
