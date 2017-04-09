<?php namespace estvoyage\risingsun\comparison\unary\with\true;

use estvoyage\risingsun\{ comparison, block };

class boolean extends comparison\unary\switcher
	implements
		comparison\unary
{
	function operandForComparisonIs($value)
	{
		return $this
			->blockIs(
				new block\functor(
					function($ok, $ko) use ($value)
					{
						($value === true ? $ok : $ko)->blockArgumentsAre($value);
					}
				)
			)
		;
	}
}
