<?php namespace estvoyage\risingsun\ofloat\comparison;

use estvoyage\risingsun\{ ofloat, oboolean };

interface binary
{
	function recipientOfOFloatComparisonBetweenOFloatsIs(ofloat $firstOperand, ofloat $secondOperand, oboolean\recipient $recipient);
}
