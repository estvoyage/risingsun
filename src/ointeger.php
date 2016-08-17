<?php namespace estvoyage\risingsun;

class ointeger
{
	private
		$value
	;

	function __construct($value = 0)
	{
		if (! is_numeric($value) || (int) $value != $value)
		{
			throw new \domainException('Value should be an integer');
		}

		$this->value = (int) $value;
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

	function ifIsLessThan(self $integer, callable $isLessThan, callable $isNotLessThan = null)
	{
		return $this->ifTrue($this->value < $integer->value, $isLessThan, $isNotLessThan);
	}

	function ifIsEqualTo(self $integer, callable $isEqualTo, callable $isNotEqualTo = null)
	{
		return $this->ifTrue($this->value == $integer->value, $isEqualTo, $isNotEqualTo);
	}

	function whileIsGreaterThan(self $integer, callable $loopBody)
	{
		for ($i = $this->value; $i > $integer->value; $i--)
		{
			$loopBody();
		}

		return $this;
	}

	function whileIsGreaterThanZero(callable $loopBody)
	{
		return $this->whileIsGreaterThan(new self, $loopBody);
	}

	static function newFromNothing()
	{
		return new static;
	}

	static function newFromInteger(self $integer)
	{
		$new = static::newFromNothing();

		$new->value = $integer->value;

		return $new;
	}

	private function ifTrue($boolean, callable $true, callable $false = null)
	{
		$boolean ? $true() : call_user_func($false ?: function() {});

		return $this;
	}
}
