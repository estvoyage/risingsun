<?php namespace estvoyage\risingsun\ointeger\comparison;

use estvoyage\risingsun\{ ointeger, block };

interface unary
{
	function blockForComparisonWithOIntegerIs(ointeger $ointeger, block $block);
}
