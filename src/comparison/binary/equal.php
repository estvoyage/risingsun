<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\comparison;

class equal
	implements
		comparison\binary
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient)
	{
		$recipient->{'comparisonIs' . ($firstOperand == $secondOperand ? 'True' : 'False')}();

		return $this;
	}
}
