<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\comparison;

class identical
	implements
		comparison
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient)
	{
		$recipient->{'comparisonIs' . ($firstOperand === $secondOperand ? 'True' : 'False')}();

		return $this;
	}
}
