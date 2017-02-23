<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, block, oboolean };

interface unary
{
	function blockForComparisonWithOIntegerIs(ointeger $ointeger, block $block);
	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger $ointeger, oboolean\recipient $recipient);
}
