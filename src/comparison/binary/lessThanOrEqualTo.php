<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, oboolean };

class lessThanOrEqualTo extends equal
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		return parent::recipientOfComparisonBetweenValuesIs($firstOperand <= $secondOperand, true, $recipient);
	}
}
