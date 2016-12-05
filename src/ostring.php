<?php namespace estvoyage\risingsun;

class ostring
{
	private
		$value
	;

	function __construct($value = '')
	{
		oboolean::isString($value)
			->ifTrue(new block\functor(function() use ($value) { $this->value = (string) $value; }))
			->ifFalse(new block\functor(function() { throw new \domainException('Value must be a string'); }))
		;
	}

	function __toString()
	{
		return $this->value;
	}

	function ifIsEqualToString(self $string, block $equal, block $notEqual = null)
	{
		return $this->ifTrue(oboolean::isEqual($this->value, $string->value), $equal, $notEqual);
	}

	function ifIsNotEqualToString(self $string, block $notEqual, block $equal = null)
	{
		return $this->ifIsEqualToString($string, $equal ?: new block\blackhole, $notEqual);
	}

	function ifIsEmptyString(block $empty, block $notEmpty = null)
	{
		return $this->ifIsEqualToString(new self, $empty, $notEmpty);
	}

	function ifIsNotEmptyString(block $notEmpty, block $empty = null)
	{
		return $this->ifIsNotEqualToString(new self, $notEmpty, $empty);
	}

	function ifIsStartOfString(self $string, block $isStart, block $isNotStart = null)
	{
		$string->ifStartWithString($this, $isStart, $isNotStart);

		return $this;
	}

	function ifStartWithString(self $string, block $startWithString, block $notStartWithString = null)
	{
		return $this->ifTrue(oboolean::stringIsStartOfString($string->value, $this->value), $startWithString, $notStartWithString);
	}

	function ifIsInteger(block $isInteger, block $isNotInteger = null)
	{
		return $this->ifTrue(oboolean::isInteger($this->value), $isInteger, $isNotInteger);
	}

	function ifIsNotNumeric(block $isNotNumeric, block $isNumeric = null)
	{
		return $this->ifTrue(oboolean::isNotNumeric($this->value), $isNotNumeric, $isNumeric);
	}

	function recipientOfStringLengthIs(ostring\length\recipient $recipient)
	{
		$recipient->stringLengthIs(new ostring\length(strlen($this->value)));

		return $this;
	}

	function recipientOfStringBeforeLastStringIs(ostring\notEmpty $lastString, ostring\recipient $recipient)
	{
		$lastPosition = strrpos($this->value, $lastString->value);

		oboolean::isTrue($lastPosition > 0)
			->ifTrue(
				new block\functor(
					function() use ($lastPosition, $recipient)
					{
						$recipient->ostringIs(self::cloneWithValue($this, substr($this->value, 0, $lastPosition)));
					}
				)
			)
		;

		return $this;
	}

	function recipientOfStringAfterLastStringIs(ostring\notEmpty $lastString, ostring\recipient $recipient)
	{
		$lastPosition = strrpos($this->value, $lastString->value);

		oboolean::isNotFalse($lastPosition)
			->ifTrue(
				new block\functor(
					function() use ($lastString, $lastPosition, $recipient)
					{
						$value = substr($this->value, $lastPosition + strlen($lastString));

						oboolean::isNotEmptyString($value)
							->ifTrue(
								new block\functor(
									function() use ($value, $recipient)
									{
										$recipient->ostringIs(self::cloneWithValue($this, $value));
									}
								)
							)
						;
					}
				)
			)
		;

		return $this;
	}

	function recipientOfStringWithoutPrefixIs(ostring\notEmpty $prefix, ostring\recipient $recipient)
	{
		$value = substr_replace($this->value, '', 0, strlen($prefix->value));

		oboolean::isEqual($this->value, $value)
			->ifFalse(
				new block\functor(
					function() use ($value, $recipient)
					{
						$recipient->ostringIs(self::cloneWithValue($this, $value));
					}
				)
			)
		;

		return $this;
	}

	private function ifTrue(oboolean $boolean, block $true, block $false = null)
	{
		$boolean
			->ifTrue($true)
			->ifFalse($false ?: new block\blackhole)
		;

		return $this;
	}

	private static function cloneWithValue(self $string, $value)
	{
		$string = clone $string;
		$string->value = $value;

		return $string;
	}
}
