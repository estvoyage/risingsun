<?php namespace estvoyage\risingsun\tests\units\comparison\conjunction;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, comparison as mockOfComparison, ointeger as mockOfOInteger, container as mockOfContainer };

class payload extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('estvoyage\risingsun\comparison\container\payload');
	}

	function testIteratorControllerForComparisonAtPositionIs()
	{
		$this
			->given(
				$firstOperand = uniqid(),
				$secondOperand = uniqid(),
				$comparison = new mockOfComparison,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller
			)
			->if(
				$this->newTestedInstance($firstOperand, $secondOperand)
			)
			->then
				->object($this->testedInstance->iteratorControllerForComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('nextIterationsAreUseless')
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
				->object($this->testedInstance->iteratorControllerForComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('nextIterationsAreUseless')
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
				->object($this->testedInstance->iteratorControllerForComparisonAtPositionIs($comparison, $position, $controller))
					->isEqualTo($this->newTestedInstance($firstOperand, $secondOperand))
				->mock($controller)
					->receive('nextIterationsAreUseless')
						->once
		;
	}
}
