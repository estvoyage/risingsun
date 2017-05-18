<?php namespace estvoyage\risingsun\ofloat\comparison;

use estvoyage\risingsun\{ ofloat, comparison };

interface binary
{
	function recipientOfOFloatComparisonBetweenOperandAndReferenceIs(ofloat $operand, ofloat $reference, comparison\recipient $recipient);
}
