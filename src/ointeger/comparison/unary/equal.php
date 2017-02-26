<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block, oboolean, block\functor };

class equal
	implements
		ointeger\comparison\unary
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
		(new ointeger\comparison\binary\equal)
			->recipientOfOIntegerComparisonBetweenOIntegersIs(
				$this->reference,
				$ointeger,
				$recipient
			)
		;

		return $this;
	}
}
