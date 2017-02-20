<?php namespace estvoyage\risingsun\container\iterator\position;

use estvoyage\risingsun\{ ointeger\comparison, ointeger, container\iterator\controller, block\functor };

class comparator
{
	private
		$comparison
	;

	function __construct(comparison\unary $comparison)
	{
		$this->comparison = $comparison;
	}

	function iteratorControllerForPositionIs(ointeger $position, controller $controller)
	{
		$this->comparison
			->blockForComparisonWithOIntegerIs(
				$position,
				new functor(
					function() use ($controller)
					{
						$controller->nextContainerValuesAreUseless();
					}
				)
			)
		;

		return $this;
	}
}
