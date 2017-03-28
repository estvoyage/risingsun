<?php namespace estvoyage\risingsun\comparison\binary\conjunction;

use estvoyage\risingsun\{ comparison, container, ointeger, oboolean, oboolean\recipient\functor };

class payload
	implements
		comparison\binary\container\payload
{
	private
		$firstOperand,
		$secondOperand,
		$recipient
	;

	function __construct($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		$this->firstOperand = $firstOperand;
		$this->secondOperand = $secondOperand;
		$this->recipient = $recipient;
	}

	function containerIteratorEngineControllerForBinaryComparisonAtPositionIs(comparison\binary $comparison, ointeger $position, container\iterator\engine\controller $controller)
	{
		$comparison->recipientOfComparisonBetweenValuesIs(
			$this->firstOperand,
			$this->secondOperand,
			new functor(
				function($oboolean) use ($controller)
				{
					$oboolean
						->blockForFalseIs(
							new functor(
								function() use ($controller)
								{
									$controller->remainingIterationsInContainerIteratorEngineAreUseless();
								}
							)
						)
					;

					$this->recipient->obooleanIs($oboolean);
				}
			)
		);

		return $this;
	}
}
