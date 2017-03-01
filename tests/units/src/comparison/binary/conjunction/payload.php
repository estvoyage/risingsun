<?php namespace estvoyage\risingsun\tests\units\comparison\binary\conjunction;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, ointeger as mockOfOInteger, container as mockOfContainer };

class payload extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('estvoyage\risingsun\comparison\binary\container\payload');
	}

	function testIteratorControllerForComparisonAtPositionIs()
	{
		$this
			->given(
				$firstOperand = uniqid(),
				$secondOperand = uniqid(),
				$comparison = new mockOfComparison\binary,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand)
			)
			->then
				->object($this->testedInstance->iteratorControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('remainingIterationsAreUseless')
						->never

			->if(
				$this->calling($comparison)->recipientOfComparisonBetweenValuesIs = function($aFirstOperand, $aSecondOperand, $aRecipient) use ($firstOperand, $secondOperand) {
					if ($firstOperand == $aFirstOperand && $secondOperand == $aSecondOperand)
					{
						$aRecipient->comparisonIsTrue();
					}
				}
			)
			->then
				->object($this->testedInstance->iteratorControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('remainingIterationsAreUseless')
						->never

			->if(
				$this->calling($comparison)->recipientOfComparisonBetweenValuesIs = function($aFirstOperand, $aSecondOperand, $aRecipient) use ($firstOperand, $secondOperand) {
					if ($firstOperand == $aFirstOperand && $secondOperand == $aSecondOperand)
					{
						$aRecipient->comparisonIsFalse();
					}
				}
			)
			->then
				->object($this->testedInstance->iteratorControllerForBinaryComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('remainingIterationsAreUseless')
						->once
		;
	}
}
