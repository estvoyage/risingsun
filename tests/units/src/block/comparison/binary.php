<?php namespace estvoyage\risingsun\tests\units\block\comparison;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, comparison, block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, oboolean as mockOfOBoolean, comparison as mockOfComparison };

class binary extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$firstOperand = uniqid(),
				$secondOperand = uniqid(),
				$block = new mockOfBlock,
				$comparison = new mockOfComparison\binary
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand, $comparison, $block)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $comparison, $block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->given(
				$this->calling($comparison)->recipientOfComparisonBetweenValuesIs = function($aFirstOperand, $aSecondOperand, $recipient) use ($firstOperand, $secondOperand, & $oboolean) {
					(
						new comparison\pipe(
							new comparison\identical($aFirstOperand, $firstOperand),
							new comparison\identical($aSecondOperand, $secondOperand)
						)
					)
						->recipientOfComparisonIs(
							new oboolean\recipient\forward(
								$recipient,
								$oboolean
							)
						)
					;
				}
			)

			->if(
				$oboolean = new oboolean\ko
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $comparison, $block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->never

			->if(
				$oboolean = new oboolean\ok
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $comparison, $block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
