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

	function ifEqualToString(self $string, callable $equal, callable $notEqual = null)
	{
		return $this->ifTrue($this->value == (string) $string, $equal, $notEqual);
	}

	function ifNotEqualToString(self $string, callable $notEqual, callable $equal = null)
	{
		return $this->ifEqualToString($string, $equal ?: function() {}, $notEqual);
	}

	function ifIsEmptyString(callable $empty, callable $notEmpty = null)
	{
		return $this->ifEqualToString(new self, $empty, $notEmpty);
	}

	function ifIsNotEmptyString(callable $notEmpty, callable $empty = null)
	{
		return $this->ifNotEqualToString(new self, $notEmpty, $empty);
	}

	function ifIsStartOfString(self $string, callable $isStart, callable $isNotStart = null)
	{
		$string->ifStartWithString($this, $isStart, $isNotStart);

		return $this;
	}

	function ifStartWithString(self $string, callable $startWithString, callable $notStartWithString = null)
	{
		return $this->ifTrue($this != '' && $string != '' && strpos((string) $this, (string) $string) === 0, $startWithString, $notStartWithString);
	}

	function ifIsInteger(callable $isInteger, callable $isNotInteger = null)
	{
		return $this->ifTrue(is_numeric($this->value) && (int) $this->value == $this->value, $isInteger, $isNotInteger);
	}

	function ifIsNotNumeric(callable $isNotNumeric, callable $isNumeric = null)
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

	private function ifTrue($boolean, callable $true, callable $false = null)
	{
		$boolean ? $true() : call_user_func($false ?: function() {});

		return $this;
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
