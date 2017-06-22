<?php namespace estvoyage\risingsun\datum\comparison;

use estvoyage\risingsun\{ datum, comparison };

interface binary
{
	function recipientOfDatumComparisonBetweenOperandAndReferenceIs(datum $operand, datum $reference, comparison\recipient $recipient) :void;
}
