<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\ofloat;

class any
	implements
		ofloat\comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct(ofloat\comparison\binary $comparison, ofloat $reference = null)
	{
		$this->comparison = $comparison;
		$this->reference = $reference ?: new ofloat\any;
	}

	function oFloatForComparisonIs(ofloat $ofloat)
	{
		$this->comparison
			->referenceForComparisonWithOFloatIs(
				$ofloat,
				$this->reference
			)
		;

		return $this;
	}
}
