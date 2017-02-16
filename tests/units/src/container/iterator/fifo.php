<?php namespace estvoyage\risingsun\tests\units\container\iterator;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, container, oboolean };
use mock\estvoyage\risingsun\container as mockOfContainer;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator')
		;
	}

	function testPayloadForContainerValuesIs()
	{
		$this
			->given(
				$values = range(0, 3),
				$payload = new mockOfContainer\payload,
				$controller = new mockOfContainer\iterator\controller
			)
			->if(
				$this->newTestedInstance($controller)
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->never

			->if(
			$this->calling($controller)->blockToStopContainerIteratorEngineIs = function($iteration, $block) use ($controller, & $stopBlock) {
					$stopBlock = $block;

					$iteration->controllerOfContainerIteratorIs($controller);
				}
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->withArguments(0, new container\iterator\position, $controller)
							->once
						->withArguments(1, new container\iterator\position(1), $controller)
							->once
						->withArguments(2, new container\iterator\position(2), $controller)
							->once
						->withArguments(3, new container\iterator\position(3), $controller)
							->once

			->if(
				$this->calling($payload)->containerIteratorControllerForValueAtPositionIs = function($value, $position, $controller) {
					$controller->nextContainerValuesAreUseless();
				},

				$this->calling($controller)->nextContainerValuesAreUseless = function() use (& $stopBlock) {
					$stopBlock->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->withArguments(0, new container\iterator\position, $controller)
							->twice
						->withArguments(1, new container\iterator\position(1), $controller)
							->once
						->withArguments(2, new container\iterator\position(2), $controller)
							->once
						->withArguments(3, new container\iterator\position(3), $controller)
							->once
		;
	}
}
