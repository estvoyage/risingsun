<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\comparison;

interface binary
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient);
}
