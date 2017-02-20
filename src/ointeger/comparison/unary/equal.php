<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger\comparison, ointeger, block };

class equal
	implements
		comparison\unary
{
	private
		$reference
	;

	function __construct(ointeger $reference)
	{
		$this->reference = $reference;
	}

	function blockForComparisonWithOIntegerIs(ointeger $ointeger, block $block)
	{
		(new comparison\equal)
			->blockForComparisonBetweenOIntegersIs(
				$this->reference,
				$ointeger,
				$block
			)
		;

		return $this;
	}
}
