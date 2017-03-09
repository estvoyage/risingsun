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

	function recipientOfOIntegerWithNIntegerIs(int $value, recipient $recipient)
	{
		$ointeger = clone $this;
		$ointeger->value = $value;

		$recipient->ointegerIs($ointeger);

		return $this;
	}

	function recipientOfOIntegerOperationIs(ointeger\operation\unary $operation, ointeger\recipient $recipient)
	{
		$operation->recipientOfOperationWithOIntegerIs($this, $recipient);

		return $this;
	}

	function recipientOfOIntegerOperationWithOIntegerIs(ointeger\operation\binary $operation, ointeger $ointeger, ointeger\recipient $recipient)
	{
		$operation->recipientOfOperationOnOIntegersIs($this, $ointeger, $recipient);

		return $this;
	}

	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger\comparison\binary $comparison, ointeger $ointeger, oboolean\recipient $recipient)
	{
		$comparison->recipientOfOIntegerComparisonBetweenOIntegersIs($this, $ointeger, $recipient);

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs((string) $this->value);

		return $this;
	}

	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient)
	{
		if (is_numeric($value) && (int) $value == $value)
		{
			$datum = clone $this;
			$datum->value = (int) $value;

			$recipient->datumIs($datum);
		}

		return $this;
	}

	function recipientOfDatumOperationWithDatumIs(datum\operation\binary $operation, datum $datum, datum\recipient $recipient)
	{
		$operation
			->recipientOfDatumOperationOnDataIs(
				$this,
				$datum,
				$recipient
			)
		;

		return $this;
	}

	function recipientOfDatumOperationIs(datum\operation\unary $operation, datum\recipient $recipient)
	{
		$operation
			->recipientOfDatumOperationWithDatumIs(
				$this,
				$recipient
			)
		;

		return $this;
	}

	function recipientOfOIntegerComparisonIs(ointeger\comparison\unary $comparison, oboolean\recipient $recipient)
	{
		$comparison
			->recipientOfOIntegerComparisonWithOIntegerIs(
				$this,
				$recipient
			)
		;

		return $this;
	}

	function recipientOfDatumLengthComparisonIs(datum\length\comparison $comparison, oboolean\recipient $recipient)
	{
		$comparison
			->recipientOfDatumLengthComparisonWithDatumLengthIs(new ointeger\unsigned\any(strlen($this->value)), $recipient)
		;

		return $this;
	}
}
