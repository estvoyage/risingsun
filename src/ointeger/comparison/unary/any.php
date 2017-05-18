<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, comparison };

class any
	implements
		ointeger\comparison\unary
{
	private
		$comparison,
		$reference
	;

	function __construct(ointeger\comparison\binary $comparison, ointeger $reference)
	{
		$this->comparison = $comparison;
		$this->reference = $reference;
	}

	function recipientOfComparisonWithOIntegerIs(ointeger $ointeger, comparison\recipient $recipient)
	{
		$this->comparison
			->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(
				$ointeger,
				$this->reference,
				$recipient
			)
		;

		return $this;
	}
}
