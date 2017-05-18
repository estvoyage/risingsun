<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\block;

interface binary
{
	function recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, recipient $recipient);
}
