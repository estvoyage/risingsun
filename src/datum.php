<?php namespace estvoyage\risingsun;

interface datum
{
	function recipientOfNStringIs(nstring\recipient $recipient);
	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient);
	function recipientOfDatumOperationWithDatumIs(datum\operation\binary $operation, datum $datum, datum\recipient $recipient);
	function recipientOfDatumOperationIs(datum\operation\unary $operation, datum\recipient $recipient);
	function recipientOfDatumLengthComparisonIs(datum\length\comparison $comparison, oboolean\recipient $recipient);
}
