<?php namespace estvoyage\risingsun\nstring\operation\binary;

use estvoyage\risingsun\nstring;

class addition
	implements
		nstring\operation\binary
{
	function recipientOfOperationOnNStringsIs(string $firstOperand, string $secondOperand, nstring\recipient $recipient)
	{
		$recipient->nstringIs($firstOperand . $secondOperand);

		return $this;
	}
}
