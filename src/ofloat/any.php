<?php namespace estvoyage\risingsun\ofloat;

use estvoyage\risingsun\{ ofloat, nfloat, datum, ointeger, nstring };

class any
	implements
		ofloat,
		datum
{
	private
		$value
	;

	function __construct($value = 0.)
	{
		if (! self::check($value))
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

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		if (self::check($value))
		{
			$datum = clone $this;
			$datum->value = $value;

			$recipient->datumIs($datum);
		}

		return $this;
	}

	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient)
	{
		$recipient->unsignedOIntegerIs(new ointeger\unsigned\any(strlen($this->value)));

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs((string) $this->value);

		return $this;
	}

	private static function check($value)
	{
		return is_numeric($value) && (float) $value == $value;
	}
}
