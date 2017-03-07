<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\risingsun\comparison;

class conjunction
	implements
		comparison\recipient
{
	function comparisonIsTrue()
	{
		return $this;
	}

	function comparisonIsFalse()
	{
		return $this;
	}
}
