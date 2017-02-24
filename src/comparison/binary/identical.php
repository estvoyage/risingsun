<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, oboolean };

class identical
	implements
		comparison\binary
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		$recipient->obooleanIs($firstOperand === $secondOperand ? new oboolean\ok : new oboolean\ko);

		return $this;
	}
}
