<?php namespace estvoyage\risingsun\comparison\binary;

class lessThanOrEqualTo extends equal
{
	function referenceForComparisonWithOperandIs($operand, $reference)
	{
		return parent::referenceForComparisonWithOperandIs($operand <= $reference, true);
	}
}
