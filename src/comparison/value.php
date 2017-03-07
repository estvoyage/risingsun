<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean };

class value
	implements
		comparison
{
	private
		$value,
		$comparison
	;

	function __construct($value, comparison\unary $comparison)
	{
		$this->value = $value;
		$this->comparison = $comparison;
	}

	function recipientOfComparisonIs(oboolean\recipient $recipient)
	{
		$this->comparison
			->recipientOfComparisonWithValueIs(
				$this->value,
				$recipient
			)
		;

		return $this;
	}
}
