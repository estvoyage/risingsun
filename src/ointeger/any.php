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
		(new comparison\unary\with\magic\toString)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\functor\ok(
					function() use (& $value)
					{
						$value = (string) $value;
					}
				)
			)
		;

		(new comparison\unary\with\integer\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\switcher(
					new block\functor(
						function() use ($value)
						{
							$this->value = (int) $value;
						}
					),
					new block\error(
						new \typeError('Value should be an integer')
					)
				)
			)
		;
	}

	function recipientOfNIntegerIs(ninteger\recipient $recipient)
	{
		$recipient->nintegerIs($this->value);

		return $this;
	}

	function recipientOfOIntegerWithNIntegerIs(int $value, recipient $recipient)
	{
		$recipient->ointegerIs($this->cloneWithValue($value));

		return $this;
	}

	function recipientOfOIntegerWithOIntegerIs(ointeger $ointeger, recipient $recipient)
	{
		$ointeger
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($ninteger) use ($recipient)
					{
						$this
							->recipientOfOIntegerWithNIntegerIs(
								$ninteger,
								$recipient
							)
						;
					}
				)
			)
		;

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient) :void
	{
		$recipient->nstringIs((string) $this->value);
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient) :void
	{
		(new comparison\unary\with\integer\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\functor\ok(
					function() use ($value, $recipient)
					{
						$recipient->datumIs(self::cloneWithValue($value));
					}
				)
			)
		;
	}

	function recipientOfDatumFromDatumIs(datum $datum, datum\recipient $recipient) :void
	{
		$datum
			->recipientOfNStringIs(
				new nstring\recipient\functor(
					function($nstring) use ($recipient)
					{
						$this
							->recipientOfDatumWithNStringIs(
								$nstring,
								$recipient
							)
						;
					}
				)
			)
		;
	}

	private function cloneWithValue($value)
	{
		$ointeger = clone $this;
		$ointeger->value = $value;

		return $ointeger;
	}
}
