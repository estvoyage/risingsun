<?php namespace estvoyage\risingsun;

class ostring
{
	private
		$value
	;

	function __construct($value = '')
	{
		self::valueForStringIs($this, $value);
	}

	function __toString()
	{
		return $this->value;
	}

	function valueIs($value)
	{
		return self::valueForStringIs(clone $this, $value);
	}

	function ifEqualToString(self $string, block $equal, block $notEqual = null)
	{
		return $this->ifTrue($this->value == (string) $string, $equal, $notEqual);
	}

	function ifNotEqualToString(self $string, block $notEqual, block $equal = null)
	{
		return $this->ifEqualToString($string, $equal ?: new block\blackhole, $notEqual);
	}

	function ifIsEmptyString(block $empty, block $notEmpty = null)
	{
		return $this->ifEqualToString(new self, $empty, $notEmpty);
	}

	function ifIsNotEmptyString(block $notEmpty, block $empty = null)
	{
		return $this->ifNotEqualToString(new self, $notEmpty, $empty);
	}

	function ifIsStartOfString(self $string, block $isStart, block $isNotStart = null)
	{
		$string->ifStartWithString($this, $isStart, $isNotStart);

		return $this;
	}

	function ifStartWithString(self $string, block $startWithString, block $notStartWithString = null)
	{
		return $this->ifTrue($this != '' && $string != '' && strpos((string) $this, (string) $string) === 0, $startWithString, $notStartWithString);
	}

	function ifIsInteger(block $isInteger, block $isNotInteger = null)
	{
		return $this->ifTrue(is_numeric($this->value) && (int) $this->value == $this->value, $isInteger, $isNotInteger);
	}

	function ifIsNotNumeric(block $isNotNumeric, block $isNumeric = null)
	{
		return $this->ifTrue(! is_numeric($this->value), $isNotNumeric, $isNumeric);
	}

	function recipientOfStringLengthIs(ostring\length\recipient $recipient)
	{
		$recipient->stringLengthIs(new ostring\length(strlen($this->value)));

		return $this;
	}

	function ostringOffsetIs(ostring\offset $offset)
	{
		$string = clone $this;

		for ($i = $offset->value; $i > 0; $i--)
		{
			$string->value++;
		}

		return $string;
	}

	private function ifTrue($boolean, block $true, block $false = null)
	{
		self::selectBlockAccordingTo($boolean, $true, $false)->blockArgumentsAre();

		return $this;
	}

	private static function selectBlockAccordingTo($boolean, block $true, block $false = null)
	{
		return ($boolean ? $true : $false ?: new blackhole);
	}

	private static function valueForStringIs(self $string, $value)
	{
		switch (true)
		{
			case is_string($value):
				break;

			case is_object($value) && method_exists($value, '__toString'):
				$value = (string) $value;
				break;

			default:
				throw new \domainException('Value should be a string');
		}

		$string->value = $value;

		return $string;
	}
}
