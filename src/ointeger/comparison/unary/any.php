<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, ointeger\comparison, oboolean };

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
