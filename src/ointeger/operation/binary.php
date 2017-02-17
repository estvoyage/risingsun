<?php namespace estvoyage\risingsun\ointeger\operation;

use estvoyage\risingsun\ointeger;

interface binary
{
	function recipientOfOperationOnIntegersIs(ointeger $firstOperand, ointeger $secondOperand, ointeger\recipient $recipient);
}
