<?php namespace estvoyage\risingsun\ninteger\operation;

use estvoyage\risingsun\ninteger\recipient;

interface binary
{
	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient);
}
