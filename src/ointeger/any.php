<?php namespace estvoyage\risingsun\ointeger;

use estvoyage\risingsun\{ ointeger, ninteger, block, nstring, datum, comparison };

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

		(
			new comparison\unary\with\integer\type(
				new block\functor(
					function() use ($value)
					{
						$this->value = (int) (string) $value;
					}
				),
				new block\error(new \typeError('Value should be an integer'))
			)
		)
			->operandForComparisonIs($value)
		;
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
		(
			new comparison\unary\with\integer\type
			(
				new block\functor(
					function() use ($value, $recipient)
					{
						$recipient->datumIs(self::cloneWithValue($value));
					}
				)
			)
		)
			->operandForComparisonIs(
				$value
			)
		;

		return $this;
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient)
	{
		$recipient->datumLengthIs(new datum\length(strlen($this->value)));

		return $this;
	}

	private function cloneWithValue($value)
	{
		$ointeger = clone $this;
		$ointeger->value = $value;

		return $ointeger;
	}
}
