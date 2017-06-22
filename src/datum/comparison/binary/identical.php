<?php namespace estvoyage\risingsun\datum\comparison\binary;

use estvoyage\risingsun\{ datum, comparison };

class identical extends comparison\binary\identical
	implements
		datum\comparison\binary
{
	function recipientOfDatumComparisonBetweenOperandAndReferenceIs(datum $operand, datum $reference, comparison\recipient $recipient) :void
	{
		$this->recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, $recipient);
	}
}
