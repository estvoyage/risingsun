<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, oboolean, block };

interface binary
{
	function recipientOfOIntegerComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, oboolean\recipient $recipient);
	function blockForOIntegerComparisonBetweenOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, block $block);
}
