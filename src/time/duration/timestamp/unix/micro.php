<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\{ nfloat, ostring, ointeger, block\functor, datum, nstring, block, oboolean };

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

	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient)
	{
		$recipient->unsignedOIntegerIs(new ointeger\unsigned\any(strlen($this->value)));

		return $this;
	}

	function recipientOfPartAtRightOfRadixWithPrecisionIs(ointeger\unsigned $precision, datum\recipient $recipient)
	{
		$datum = new ostring\any($this->value);

		(
			new datum\finder\operation(
				new datum\finder\first,
				new ointeger\operation\unary\addition(new ointeger\any(1))
			)
		)
			->recipientOfSearchOfDatumInDatumIs(
				new ostring\any('.'),
				$datum,
				new functor(
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
								new functor(
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

		return $this;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs($this->value);

		return $this;
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
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

	function recipientOfDatumLengthComparisonIs(datum\length\comparison $comparison, oboolean\recipient $recipient)
	{
		$comparison
			->recipientOfDatumLengthComparisonWithDatumLengthIs(
				new ointeger\unsigned\any(strlen($this->value)),
				$recipient
			)
		;

		return $this;
	}
}
