<?php namespace estvoyage\risingsun\container\iterator\position;

use estvoyage\risingsun\{ ointeger\comparison, ointeger, container\iterator\controller, block\functor, datum };

class comparator
	implements
		datum\container\payload
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
			->recipientOfOIntegerComparisonWithOIntegerIs(
				$position,
				new functor(
					function($oboolean) use ($controller)
					{
						$oboolean
							->blockForTrueIs(
								new functor(
									function() use ($controller)
									{
										$controller->nextIterationsAreUseless();
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

	function containerIteratorControllerForDatumAtPositionIs(datum $datum, ointeger $position, controller $controller)
	{
		return $this->iteratorControllerForPositionIs($position, $controller);
	}
}
