<?php namespace estvoyage\risingsun\ofloat;

use estvoyage\risingsun\{ ofloat, nfloat, datum, ointeger, nstring, comparison, ostring, block };

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
		(new comparison\unary\not\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\error(
					new \typeError('Value should be a float')
				)
			)
		;

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

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient) :void
	{
		(new comparison\unary\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\functor\ok(
					function() use ($recipient, $value)
					{
						$recipient->datumIs($this->cloneWithValue($value));
					}
				)
			)
		;
	}

	function recipientOfNStringIs(nstring\recipient $recipient) :void
	{
		$recipient->nstringIs((string) $this->value);
	}

	function recipientOfPartAtRightOfRadixWithPrecisionIs(ointeger\unsigned $precision, datum\recipient $recipient)
	{
		(new datum\converter\any)
			->recipientOfDatumIs(
				$this,
				new datum\recipient\functor(
					function($datum) use ($precision, $recipient)
					{
						(
							new datum\finder\operation(
								new datum\finder\first,
								new ointeger\operation\unary\addition(new ointeger\any(1))
							)
						)
							->recipientOfSearchOfDatumInDatumIs(
								new ostring\any('.'),
								$datum,
								new datum\finder\recipient\functor(
									function($position) use ($precision, & $datum)
									{
										(
											new datum\operation\unary\pipe(
												new datum\operation\unary\container\collection(
													new datum\operation\unary\slicer($position, $precision),
													new datum\operation\unary\padding\right($precision, new ostring\any('0'))
												)
											)
										)
											->recipientOfDatumOperationWithDatumIs(
												$datum,
												new datum\recipient\functor(
													function($rightPart) use (& $datum)
													{
														$datum = $rightPart;
													}
												)
											)
										;
									}
								)
							)
						;

						$recipient->datumIs($datum);
					}
				)
			)
		;

		return $this;
	}

	private function cloneWithValue($value)
	{
		$ofloat = clone $this;
		$ofloat->value = $value;

		return $ofloat;
	}
}
