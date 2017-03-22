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
		$recipient->ofloatIs($this->cloneWithValue($nfloat));

		return $this;
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		if (self::check($value))
		{
			$recipient->datumIs($this->cloneWithValue($value));
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

	private function cloneWithValue($value)
	{
		$ofloat = clone $this;
		$ofloat->value = $value;

		return $ofloat;
	}

	private static function check($value)
	{
		return is_numeric($value) && (float) $value == $value;
	}
}
