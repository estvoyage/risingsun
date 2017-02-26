<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor };

class equal
	implements
		ointeger\comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct(ointeger $reference, ointeger\comparison\binary\equal $comparison = null)
	{
		$this->reference = $reference;
		$this->comparison = $comparison ?: new ointeger\comparison\binary\equal;
	}

	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger $ointeger, oboolean\recipient $recipient)
	{
		$this->comparison
			->recipientOfOIntegerComparisonBetweenOIntegersIs(
				$this->reference,
				$ointeger,
				$recipient
			)
		;

		return $this;
	}
}
