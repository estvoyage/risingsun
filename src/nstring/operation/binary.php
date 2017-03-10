<?php namespace estvoyage\risingsun\nstring\operation;

use estvoyage\risingsun\nstring\recipient;

interface binary
{
	function recipientOfOperationOnNStringsIs(string $firstOperand, string $secondOperand, recipient $recipient);
}
