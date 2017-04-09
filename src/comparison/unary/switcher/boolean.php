<?php namespace estvoyage\risingsun\comparison\unary\switcher;

use estvoyage\risingsun\{ comparison, block };

class boolean extends comparison\unary\switcher
{
	function booleanForValueIs($value, bool $boolean)
	{
		return $this
			->blockIs(
				new block\functor(
					function($ok, $ko) use ($value, $boolean)
					{
						(
							new comparison\unary\with\true\boolean
							(
								new block\fowarder($value, $ok),
								new block\fowarder($value, $ko)
							)
						)
							->operandForComparisonIs(
								$boolean
							)
						;
					}
				)
			)
		;
	}
}
