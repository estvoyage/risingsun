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

	function recipientOfPartAtRightOfRadixWithPrecisionIs(ointeger\unsigned $precision, datum\recipient $recipient)
	{
		$datum = new ostring\any($this->value);

		(
			new class(new ostring\any($this->value), $precision)
				implements
					datum\finder\recipient,
					datum\recipient
			{
				private
					$datum,
					$precision
				;

				function __construct(datum $defaultDatum, ointeger\unsigned $precision)
				{
					$this->datumIs($defaultDatum);
					$this->precision = $precision;
				}

				function recipientIs(datum\recipient $recipient)
				{
					(
						new datum\finder\operation(
							new datum\finder\first,
							new ointeger\operation\unary\addition(new ointeger\any(1))
						)
					)
						->recipientOfSearchOfDatumInDatumIs(
							new ostring\any('.'),
							$this->datum,
							$this
						)
					;

					$recipient->datumIs($this->datum);
				}

				function datumIsAtPosition(ointeger\unsigned $position)
				{
					$this->datum
						->recipientOfDatumOperationIs(
							new datum\operation\unary\pipe(
								new datum\operation\unary\container\collection(
									new datum\operation\unary\slicer($position, $this->precision),
									new datum\operation\unary\padding\right($this->precision, new ostring\any('0'))
								)
							),
							$this
						)
					;
				}

				function datumIs(datum $datum)
				{
					$this->datum = $datum;

					return $this;
				}

				function datumDoesNotExist()
				{
				}
			}
		)
			->recipientIs($recipient)
		;

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
