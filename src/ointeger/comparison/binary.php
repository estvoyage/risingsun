<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\ointeger;

interface binary
{
	function referenceForComparisonWithOIntegerIs(ointeger $operand, ointeger $reference);
}
