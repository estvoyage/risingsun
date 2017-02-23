<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger\comparison, ointeger, block, oboolean, block\functor };

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

	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger $ointeger, oboolean\recipient $recipient)
	{
		(new comparison\equal)
			->recipientOfOIntegerComparisonBetweenOIntegersIs(
				$this->reference,
				$ointeger,
				$recipient
			)
		;

		return $this;
	}

	function blockForComparisonWithOIntegerIs(ointeger $ointeger, block $block)
	{
		(new comparison\equal)
			->blockForOIntegerComparisonBetweenOIntegersIs(
				$this->reference,
				$ointeger,
				$block
			)
		;

		return $this;
	}
}
