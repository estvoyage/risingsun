<?php namespace estvoyage\risingsun\block\comparison;

use estvoyage\risingsun\{ block, block\functor, comparison };

class binary
	implements
		block
{
	private
		$firstOperand,
		$secondOperand,
		$comparison,
		$block
	;

	function __construct($firstOperand, $secondOperand, comparison\binary $comparison, block $block)
	{
		$this->firstOperand = $firstOperand;
		$this->secondOperand = $secondOperand;
		$this->comparison = $comparison;
		$this->block = $block;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->comparison
			->recipientOfComparisonBetweenValuesIs(
				$this->firstOperand,
				$this->secondOperand,
				new functor(
					function($oboolean)
					{
						$oboolean
							->blockForTrueIs(
								new functor(
									function()
									{
										$this->block->blockArgumentsAre();
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
}
