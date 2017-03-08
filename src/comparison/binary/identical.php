<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, oboolean };

class identical extends equal
	implements
		comparison\binary
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		return parent::recipientOfComparisonBetweenValuesIs($firstOperand === $secondOperand, true, $recipient);
	}
}
