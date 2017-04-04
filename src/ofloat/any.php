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
		(
			new comparison\unary\not\numeric
			(
				new block\error(new \typeError('Value should be a float'))
			)
		)
			->operandForComparisonIs($value)
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

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		(
			new comparison\unary\numeric
			(
				new block\functor(
					function() use ($recipient, $value)
					{
						$recipient->datumIs($this->cloneWithValue($value));
					}
				)
			)
		)
			->operandForComparisonIs($value)
		;

		return $this;
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient)
	{
		$recipient->datumLengthIs(new datum\length(strlen($this->value)));

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs((string) $this->value);

		return $this;
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
