<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, ointeger\comparison };

class any
	implements
		comparison\unary
{
	private
		$comparison,
		$reference
	;

	function __construct(comparison\binary $comparison, ointeger $reference = null)
	{
		$this->comparison = $comparison;
		$this->reference = $reference ?: new ointeger\any;
	}

	function oIntegerForComparisonIs(ointeger $ointeger)
	{
		$this->comparison
			->referenceForComparisonWithOIntegerIs(
				$ointeger,
				$this->reference
			)
		;

		return $this;
	}
}
