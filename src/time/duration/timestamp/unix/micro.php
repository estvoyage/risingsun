<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\nfloat;

class micro
{
	private
		$value
	;

	function __construct($value)
	{
		if (! is_numeric($value) || (float) $value != $value || $value < 0)
		{
			throw new \typeError('Value should be an unsigned float');
		}

		$this->value = $value;
	}

	function recipientOfNFloatIs(nfloat\recipient $recipient)
	{
		$recipient->nfloatIs($this->value);

		return $this;
	}
}
