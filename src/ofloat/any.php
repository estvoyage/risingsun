<?php namespace estvoyage\risingsun\ofloat;

use estvoyage\risingsun\{ ofloat, nfloat };

class any
	implements
		ofloat
{
	private
		$value
	;

	function __construct($value = 0.)
	{
		if (! is_numeric($value) || (float) $value != $value)
		{
			throw new \typeError('Value should be a float');
		}

		$this->value = $value;
	}

	function recipientOfNFloatIs(nfloat\recipient $recipient)
	{
		$recipient->nfloatIs($this->value);

		return $this;
	}

	function recipientOfOFloatWithNFloatIs(float $nfloat, ofloat\recipient $recipient)
	{
		$ofloat = clone $this;
		$ofloat->value = $nfloat;

		$recipient->ofloatIs($ofloat);

		return $this;
	}
}
