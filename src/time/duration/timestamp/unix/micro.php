<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\{ nfloat, ostring, ointeger, block\functor, datum, nstring, block };

class micro
	implements
		datum
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
		$datum = new ostring\any($this->value);

		(new datum\finder\first)
			->recipientOfSearchOfDatumInDatumIs(
				new ostring\any('.'),
				$datum,
				new datum\finder\recipient\proxy(
					new functor(
						function($position) use ($datum, $precision, $recipient)
						{
							$position
								->recipientOfOIntegerOperationIs(
									new ointeger\operation\unary\addition(
										new ointeger\any(1)
									),
									new functor(
										function($position) use ($datum, $recipient, $precision)
										{
											$datum
												->recipientOfDatumOperationIs(
													new datum\operation\unary\slicer($position, $precision),
													new functor(
														function($part) use ($precision, $recipient)
														{
															$part
																->recipientOfDatumOperationIs(
																	new datum\operation\unary\padding\right($precision, new ostring\any('0')),
																	$recipient
																)
															;
														}
													)
												)
											;
										}
									)
								)
							;
						}
					),
					new functor(
						function() use ($datum, $recipient)
						{
							$recipient->datumIs($datum);
						}
					)
				)
			)
		;

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs($this->value);

		return $this;
	}

	function recipientOfDatumWithValueIs(string $value, datum\recipient $recipient)
	{
		if (is_numeric($value) && (float) $value == $value && $value >= 0)
		{
			$recipient->datumIs(new self($value));
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
}
