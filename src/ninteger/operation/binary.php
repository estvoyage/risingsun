<?php namespace estvoyage\risingsun\ninteger\operation;

use estvoyage\risingsun\ninteger\recipient;

interface binary
{
	function recipientOfOperationWithNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient);
}
