<?php namespace estvoyage\risingsun\comparison\unary\with\true;

use estvoyage\risingsun\{ comparison, block };

class boolean
	implements
		comparison\unary
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko = null)
	{
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function operandForComparisonIs($value)
	{
		($value === true ? $this->ok : $this->ko)->blockArgumentsAre();

		return $this;
	}
}
