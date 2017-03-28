<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\{ ofloat, oboolean };

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

	function recipientOfOFloatComparisonWithOFloatIs(ofloat $ofloat, oboolean\recipient $recipient)
	{
		$this->comparison
			->recipientOfOFloatComparisonBetweenOFloatsIs(
				$ofloat,
				$this->reference,
				$recipient
			)
		;

		return $this;
	}
}
