<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\comparison;

class lessThanOrEqualTo
	implements
		comparison\binary
{
	function recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, comparison\recipient $recipient)
	{
		$recipient->nbooleanIs($operand <= $reference);
	}
}
