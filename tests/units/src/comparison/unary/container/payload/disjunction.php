<?php namespace estvoyage\risingsun\tests\units\comparison\unary\container\payload;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, ointeger as mockOfOInteger, container as mockOfContainer };

class disjunction extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary\container\payload')
		;
	}

	function testContainerIteratorEngineControllerForUnaryComparisonAtPositionIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\unary,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller,
				$this->newTestedInstance($operand = uniqid(), $recipient = new mockOfComparison\recipient)
			)
			->if(
				$this->testedInstance->containerIteratorEngineControllerForUnaryComparisonAtPositionIs($comparison, $position, $controller)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($operand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->never
				->mock($recipient)
					->receive('nbooleanIs')
						->never

			->given(
				$this->calling($comparison)->recipientOfComparisonWithOperandIs = function($operand, $recipient) {
					$recipient->nbooleanIs(false);
				}
			)
			->if(
				$this->testedInstance->containerIteratorEngineControllerForUnaryComparisonAtPositionIs($comparison, $position, $controller)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($operand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->never
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once

			->given(
				$this->calling($comparison)->recipientOfComparisonWithOperandIs = function($anOperand, $recipient) use ($operand) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$anOperand,
							$operand,
							new comparison\recipient\functor\ok(
								function() use ($recipient)
								{
									$recipient->nbooleanIs(true);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->containerIteratorEngineControllerForUnaryComparisonAtPositionIs($comparison, $position, $controller)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($operand, $recipient))
				->mock($controller)
					->receive('remainingIterationsInContainerIteratorEngineAreUseless')
						->once
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once
		;
	}
}
