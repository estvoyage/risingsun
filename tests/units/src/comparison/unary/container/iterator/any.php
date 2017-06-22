<?php namespace estvoyage\risingsun\tests\units\comparison\unary\container\iterator;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, container };
use mock\estvoyage\risingsun\{ comparison\unary as mockOfComparison, container\iterator as mockOfIterator };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary\container\iterator')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new container\iterator));
	}

	function testUnaryComparisonsForPayloadAre()
	{
		$this
			->given(
				$payload = new mockOfComparison\container\payload,
				$comparison1 = new mockOfComparison,
				$comparison2 = new mockOfComparison,
				$this->newTestedInstance($iterator = new mockOfIterator)
			)
			->if(
				$this->testedInstance->unaryComparisonsForPayloadAre($payload, $comparison1, $comparison2)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator))
				->mock($payload)
					->receive('containerIteratorEngineControllerForUnaryComparisonAtPositionIs')
						->never

			->given(
				$controller = new mockOfIterator\engine\controller,
				$position1 = new mockOfIterator\position,
				$position2 = new mockOfIterator\position,
				$this->calling($iterator)->valuesForContainerIteratorPayloadIs = function($payload, ... $values) use ($controller, $comparison1, $position1, $comparison2, $position2) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$values,
							[ $comparison1, $comparison2 ],
							new comparison\recipient\functor\ok(
								function() use ($controller, $comparison1, $position1, $comparison2, $position2, $payload)
								{
									$payload->containerIteratorEngineControllerOfValueAtPositionIs($comparison1, $position1, $controller);
									$payload->containerIteratorEngineControllerOfValueAtPositionIs($comparison2, $position2, $controller);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->unaryComparisonsForPayloadAre($payload, $comparison1, $comparison2)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator))
				->mock($payload)
					->receive('containerIteratorEngineControllerForUnaryComparisonAtPositionIs')
						->withArguments($comparison1, $position1, $controller)
							->once
						->withArguments($comparison2, $position2, $controller)
							->once
		;
	}
}
