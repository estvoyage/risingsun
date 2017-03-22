<?php namespace estvoyage\risingsun\ointeger;

use estvoyage\risingsun\{ ointeger, ninteger, oboolean, block, nstring, datum };

class any
	implements
		ointeger
{
	private
		$value
	;

	function __construct($value = 0)
	{
		if (is_object($value) && method_exists($value, '__toString'))
		{
			$value = (string) $value;
		}

		if (! self::check($value))
		{
			throw new \typeError('Value should be an integer');
		}

		$this->value = (int) (string) $value;
	}

	function recipientOfNIntegerIs(ninteger\recipient $recipient)
	{
		$recipient->nintegerIs($this->value);
	}

	function recipientOfOIntegerWithNIntegerIs(int $value, recipient $recipient)
	{
		$recipient->ointegerIs($this->cloneWithValue($value));

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs((string) $this->value);

		return $this;
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		if (self::check($value))
		{
			$recipient->datumIs(self::cloneWithValue($value));
		}

		return $this;
	}

	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient)
	{
		$recipient->unsignedOIntegerIs(new ointeger\unsigned\any(strlen($this->value)));

		return $this;
	}

	private function cloneWithValue($value)
	{
		$ointeger = clone $this;
		$ointeger->value = $value;

		return $ointeger;
	}

	private static function check($value)
	{
		return is_numeric($value) && (int) $value == $value;
	}
}
