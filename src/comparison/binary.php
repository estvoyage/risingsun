<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\oboolean;

interface binary
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient);
}
