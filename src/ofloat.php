<?php namespace estvoyage\risingsun;

class ofloat
{
	private
		$value
	;

	function __construct($value = 0.0)
	{
		if (! is_numeric($value) || (float) $value != $value)
		{
			throw new \domainException('Value should be a float');
		}

		$this->value = (float) $value;
	}

	function __get($property)
	{
		if ($property !== 'value')
		{
			throw new \logicException('Undefined property: ' . get_class($this) . '::' . $property);
		}

		return $this->value;
	}

	function __toString()
	{
		return (string) $this->value;
	}

	function recipientOfDecimalPartWithPrecisionIs(ofloat\part\decimal\precision $precision, ofloat\part\decimal\recipient $recipient)
	{
		$recipient->decimalPartIs(new ofloat\part\decimal((($this->value - (int) $this->value) * pow(10, $precision->value)) % pow(10, $precision->value)));

		return $this;
	}

	function recipientOfIntegralPartIs(ofloat\part\integral\recipient $recipient)
	{
		$recipient->integralPartIs(new ofloat\part\integral((int) $this->value));

		return $this;
	}

	function addendIsInteger(ointeger $addend)
	{
		return $this->addendIs($addend);
	}

	function addendIsFloat(self $addend)
	{
		return $this->addendIs($addend);
	}

	function factorIsFloat(self $factor)
	{
		return $this->factorIs($factor);
	}

	function factorIsInteger(ointeger $factor)
	{
		return $this->factorIs($factor);
	}

	function divisorIsInteger(ointeger\divisor $divisor)
	{
		$float = clone $this;
		$float->value /= $divisor->value;

		return $float;
	}

	private function addendIs($addend)
	{
		$float = clone $this;
		$float->value += $addend->value;

		return $float;
	}

	private function factorIs($factor)
	{
		$float = clone $this;
		$float->value *= $factor->value;

		return $float;
	}
}
