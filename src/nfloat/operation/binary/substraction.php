<?php namespace estvoyage\risingsun\nfloat\operation\binary;

use estvoyage\risingsun\{ nfloat\operation, nfloat };

class substraction
	implements
		operation\binary
{
	function recipientOfOperationOnNFloatsIs(float $firstOperand, float $secondOperand, nfloat\recipient $recipient)
	{
		$recipient->nfloatIs($firstOperand - $secondOperand);

		return $this;
	}
}
