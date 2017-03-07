<?php namespace estvoyage\risingsun\tests\units\comparison\binary\conjunction;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, ointeger as mockOfOInteger, container as mockOfContainer, oboolean as mockOfOBoolean };

class payload extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('estvoyage\risingsun\comparison\binary\container\payload');
	}

	function testContainerIteratorEngineControllerForComparisonAtPositionIs()
	{
		$this
			->given(
				$firstOperand = uniqid(),
				$secondOperand = uniqid(),
				$recipient = new mockOfOBoolean\recipient,
				$comparison = new mockOfComparison\binary,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->never
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->given(
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->calling($comparison)->recipientOfComparisonBetweenValuesIs = function($aFirstOperand, $aSecondOperand, $aRecipient) use ($firstOperand, $secondOperand, $oboolean) {
					if ($firstOperand == $aFirstOperand && $secondOperand == $aSecondOperand)
					{
						$aRecipient->obooleanIs($oboolean);
					}
				}
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->never
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($oboolean)
							->once

			->if(
				$this->calling($oboolean)->blockForFalseIs = function($block) {
					$block->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->once
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments($oboolean)
							->twice
		;
	}
}
