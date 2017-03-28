<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, oboolean };

class value
	implements
		comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct($reference = 0, comparison\binary $comparison = null)
	{
		$this->reference = $reference;
		$this->comparison = $comparison ?: new comparison\binary\equal;
	}

	function recipientOfComparisonWithValueIs($value, oboolean\recipient $recipient)
	{
		$this->comparison
			->recipientOfComparisonBetweenValuesIs(
				$value,
				$this->reference,
				$recipient
			)
		;

		return $this;
	}
}
