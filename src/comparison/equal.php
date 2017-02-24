<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean };

class equal
	implements
		comparison
{
	private
		$firstOperand,
		$secondOperand
	;

	function __construct($firstOperand, $secondOperand)
	{
		$this->firstOperand = $firstOperand;
		$this->secondOperand = $secondOperand;
	}

	function recipientOfComparisonIs(oboolean\recipient $recipient)
	{
		$recipient
			->obooleanIs(
				$this->firstOperand == $this->secondOperand
				? new oboolean\ok
				: new oboolean\ko
			)
		;

		return $this;
	}
}
