<?php namespace estvoyage\risingsun\comparison\unary\with\integer;

use estvoyage\risingsun\{ comparison, block };

class type extends comparison\unary\switcher
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
						(
							new comparison\unary\with\numeric\type
							(
								new block\functor(
									function($value) use ($ok, $ko, $value)
									{
										(
											new comparison\binary\equal(
												$ok,
												$ko
											)
										)
											->referenceForComparisonWithOperandIs(
												$value,
												(int) $value
											)
										;
									}
								),
								$ko
							)
						)
							->operandForComparisonIs(
								$value
							)
						;
					}
				)
			)
		;
	}
}
