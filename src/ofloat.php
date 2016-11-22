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

	function recipientOfFloatWithAddendIs(self $float, ofloat\addition\recipient $recipient)
	{
		$_this = clone $this;
		$_this->value += $float->value;

		$recipient->ofloatWithAddendIs($_this);

		return $this;
	}
}
