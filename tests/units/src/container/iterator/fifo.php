<?php namespace estvoyage\risingsun\tests\units\container\iterator;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, container, oboolean };
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger };

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
				$controller = new mockOfContainer\iterator\controller,
				$integerGenerator = new mockOfOInteger\generator
			)
			->if(
				$this->newTestedInstance($controller, $integerGenerator)
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->never

			->if(
				$position1 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[1] = function($recipient) use ($position1) {
					$recipient->ointegerIs($position1);
				},

				$position2 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[2] = function($recipient) use ($position2) {
					$recipient->ointegerIs($position2);
				},

				$position3 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[3] = function($recipient) use ($position3) {
					$recipient->ointegerIs($position3);
				},

				$position4 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[4] = function($recipient) use ($position4) {
					$recipient->ointegerIs($position4);
				}
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->never

			->if(
				$this->calling($controller)->blockToStopContainerIteratorEngineIs = function($engine, $block) use ($controller, & $stopBlock) {
					$stopBlock = $block;

					$engine->controllerOfContainerIteratorIs($controller);
				}
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->withIdenticalArguments(0, $position1, $controller)
							->once
						->withIdenticalArguments(1, $position2, $controller)
							->once
						->withIdenticalArguments(2, $position3, $controller)
							->once
						->withIdenticalArguments(3, $position4, $controller)
							->once

			->if(
				$position5 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[5] = function($recipient) use ($position5) {
					$recipient->ointegerIs($position5);
				},

				$position6 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[6] = function($recipient) use ($position6) {
					$recipient->ointegerIs($position6);
				},

				$position7 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[7] = function($recipient) use ($position7) {
					$recipient->ointegerIs($position7);
				},

				$position8 = new mockOfOInteger,
				$this->calling($integerGenerator)->recipientOfOIntegerIs[8] = function($recipient) use ($position8) {
					$recipient->ointegerIs($position8);
				},

				$this->calling($payload)->containerIteratorControllerForValueAtPositionIs = function($value, $position, $controller) {
					$controller->nextContainerValuesAreUseless();
				},

				$this->calling($controller)->nextContainerValuesAreUseless = function() use (& $stopBlock) {
					$stopBlock->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->withIdenticalArguments(0, $position5, $controller)
							->once
						->withIdenticalArguments(1, $position6, $controller)
							->never
						->withIdenticalArguments(2, $position7, $controller)
							->never
						->withIdenticalArguments(3, $position8, $controller)
							->never

			->given(
				$controller = new mockOfContainer\iterator\controller,
				$integerGenerator = new mockOfOInteger\generator
			)
			->if(
				$this->calling($integerGenerator)->recipientOfOIntegerIs->doesNothing,

				$this->calling($controller)->blockToStopContainerIteratorEngineIs = function($engine, $block) use ($controller) {
					$engine->controllerOfContainerIteratorIs($controller);
				},

				$this->calling($controller)->nextContainerValuesAreUseless->doesNothing,

				$this->newTestedInstance($controller, $integerGenerator)
			)
			->then
				->object($this->testedInstance->payloadForContainerValuesIs($values, $payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForValueAtPositionIs')
						->withIdenticalArguments(0)
							->twice
						->withIdenticalArguments(1)
							->once
						->withIdenticalArguments(2)
							->once
						->withIdenticalArguments(3)
							->once
		;
	}
}
