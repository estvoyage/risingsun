<?php namespace estvoyage\risingsun\ointeger;

use estvoyage\risingsun\{ ointeger, ninteger, oboolean, block };

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

		if (! is_numeric($value) || (int) $value != $value)
		{
			throw new \typeError('Value should be an integer');
		}

		$this->value = (int) (string) $value;
	}

	function recipientOfNIntegerIs(ninteger\recipient $recipient)
	{
		$recipient->nintegerIs($this->value);
	}

	function recipientOfOIntegerWithValueIs(int $value, recipient $recipient)
	{
		$ointeger = clone $this;
		$ointeger->value = $value;

		$recipient->ointegerIs($ointeger);

		return $this;
	}

	function recipientOfOperationWithOIntegerIs(ointeger\operation\binary $operation, ointeger $ointeger, ointeger\recipient $recipient)
	{
		$operation->recipientOfOperationOnIntegersIs($this, $ointeger, $recipient);

		return $this;
	}

	function recipientOfComparisonWithOIntegerIs(ointeger\comparison $comparison, ointeger $ointeger, oboolean\recipient $recipient)
	{
		$comparison->recipientOfComparisonBetweenOIntegersIs($this, $ointeger, $recipient);

		return $this;
	}

	function blockForComparisonWithOIntegerIs(ointeger\comparison $comparison, ointeger $ointeger, block $block)
	{
		$comparison->blockForComparisonBetweenOIntegersIs($this, $ointeger, $block);

		return $this;
	}
}
