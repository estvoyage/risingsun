<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\{ nfloat, ostring, ointeger, block\functor, datum };

class micro
{
	private
		$value
	;

	function __construct($value = 0.)
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

	function recipientOfPartAtRightOfRadixWithPrecisionIs(ointeger\unsigned $precision, datum\recipient $recipient)
	{
		$precision
			->recipientOfNIntegerIs(
				new functor(
					function($precision) use ($recipient)
					{
						$value = (string) $this->value;
						$radix = strpos($value, '.');

						$recipient->datumIs(
							new ostring\any(
								$radix === false
								?
								$value
								:
								str_pad(substr($value, $radix + 1, $precision), $precision, '0')
							)
						);
					}
				)
			)
		;

		return $this;
	}
}
