<?php namespace estvoyage\risingsun\nfloat\operation;

use estvoyage\risingsun\nfloat\recipient;

interface binary
{
	function recipientOfOperationOnNFloatsIs(float $firstOperand, float $secondOperand, recipient $recipient);
}
