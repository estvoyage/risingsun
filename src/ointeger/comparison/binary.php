<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, comparison };

interface binary
{
	function recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(ointeger $operand, ointeger $reference, comparison\recipient $recipient);
}
