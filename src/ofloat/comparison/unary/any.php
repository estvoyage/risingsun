<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\{ ofloat, comparison };

class any
	implements
		ofloat\comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct(ofloat\comparison\binary $comparison, ofloat $reference)
	{
		$this->comparison = $comparison;
		$this->reference = $reference;
	}

	function recipientOfComparisonWithOFloatIs(ofloat $ofloat, comparison\recipient $recipient)
	{
		$this->comparison
			->recipientOfOFloatComparisonBetweenOperandAndReferenceIs(
				$ofloat,
				$this->reference,
				$recipient
			)
		;

		return $this;
	}
}
