<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, block };

class not
	implements
		comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison\binary $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfComparisonBetweenOperandAndReferenceIs($operand, $reference, comparison\recipient $recipient)
	{
		$this->comparison
			->recipientOfComparisonBetweenOperandAndReferenceIs(
				$operand,
				$reference,
				new comparison\recipient\not($recipient)
			)
		;
	}
}
