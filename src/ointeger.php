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

	function ifIsLessThan(self $integer, block $isLessThan, block $isNotLessThan = null)
	{
		return $this->ifTrue($this->value < $integer->value, $isLessThan, $isNotLessThan);
	}

	function ifIsEqualTo(self $integer, block $isEqualTo, block $isNotEqualTo = null)
	{
		return $this->ifTrue($this->value == $integer->value, $isEqualTo, $isNotEqualTo);
	}

	function whileIsGreaterThan(self $integer, block $loopBody)
	{
		for ($i = $this->value; $i > $integer->value; $i--)
		{
			$loopBody->blockArgumentsAre();
		}

		return $this;
	}

	function whileIsGreaterThanZero(block $loopBody)
	{
		return $this->whileIsGreaterThan(new self, $loopBody);
	}

	static function toFloat(self $integer)
	{
		return new ofloat($integer->value);
	}

	private function ifTrue($boolean, block $true, block $false = null)
	{
		$block = $boolean ? $true : ($false ?: new block\blackhole);

		$block->blockArgumentsAre();

		return $this;
	}
}
