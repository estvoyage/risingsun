<?php namespace estvoyage\risingsun\comparison\binary;

class lessThan extends equal
{
	function referenceForComparisonWithOperandIs($operand, $reference)
	{
		return parent::referenceForComparisonWithOperandIs($operand < $reference, true);
	}
}
