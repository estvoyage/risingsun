<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean };

class greaterThanOrEqualTo
	implements
		comparison
{
	private
		$firstOperand,
		$secondOperand,
		$oboolean
	;

	function __construct($firstOperand, $secondOperand = 0, oboolean $oboolean = null)
	{
		$this->firstOperand = $firstOperand;
		$this->secondOperand = $secondOperand;
		$this->oboolean = $oboolean ?: new oboolean\ok;
	}

	function recipientOfComparisonIs(oboolean\recipient $recipient)
	{
		if ($this->firstOperand >= $this->secondOperand)
		{
			$recipient->obooleanIs($this->oboolean);
		}

		return $this;
	}
}
