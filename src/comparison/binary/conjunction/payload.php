<?php namespace estvoyage\risingsun\comparison\binary\conjunction;

use estvoyage\risingsun\{ comparison, container, ointeger };

class payload
	implements
		comparison\container\payload
{
	private
		$firstOperand,
		$secondOperand,
		$recipient
	;

	function __construct($firstOperand, $secondOperand)
	{
		$this->firstOperand = $firstOperand;
		$this->secondOperand = $secondOperand;
	}

	function iteratorControllerForComparisonAtPositionIs(comparison\binary $comparison, ointeger $position, container\iterator\controller $controller)
	{
		$comparison->recipientOfComparisonBetweenValuesIs(
			$this->firstOperand,
			$this->secondOperand,
			new class($controller)
				implements
					comparison\recipient
			{
				private
					$controller
				;

				function __construct(container\iterator\controller $controller)
				{
					$this->controller = $controller;
				}

				function comparisonIsTrue()
				{
				}

				function comparisonIsFalse()
				{
					$this->controller->nextIterationsAreUseless();
				}
			}
		);

		return $this;
	}
}
