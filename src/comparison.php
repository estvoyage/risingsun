<?php namespace estvoyage\risingsun;

interface comparison
{
	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient);
}
