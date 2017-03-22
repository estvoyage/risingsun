<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, ointeger\comparison, oboolean };

class any
	implements
		comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct(ointeger $reference, comparison\binary $comparison)
	{
		$this->reference = $reference;
		$this->comparison = $comparison;
	}

	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger $ointeger, oboolean\recipient $recipient)
	{
		$this->comparison
			->recipientOfOIntegerComparisonBetweenOIntegersIs(
				$ointeger,
				$this->reference,
				$recipient
			)
		;

		return $this;
	}
}
