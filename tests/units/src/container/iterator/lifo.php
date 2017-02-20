<?php namespace estvoyage\risingsun\tests\units\container\iterator;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, container, oboolean, ointeger\generator };
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger, datum as mockOfDatum };

class lifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\iterator')
		;
	}

	function testWithNoIntegerGenerator()
	{
		$this
			->given(
				$controller = new mockOfContainer\iterator\controller
			)
			->if(
				$this->newTestedInstance($controller)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($controller, new generator\operation\binary\addition))
		;
	}

	function testWithNoController()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance(new container\iterator\controller\stopper, new generator\operation\binary\addition))
		;
	}

	function testPayloadForDataIs()
	{
		$this
			->given(
				$payload = new mockOfDatum\container\payload,
				$controller = new mockOfContainer\iterator\controller,
				$integerGenerator = new mockOfOInteger\generator
			)
			->if(
				$this->newTestedInstance($controller, $integerGenerator)
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->never

			->given(
				$datum1 = new mockOfDatum,
				$datum2 = new mockOfDatum,
				$datum3 = new mockOfDatum,
				$datum4 = new mockOfDatum
			)
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
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->never

			->if(
				$this->calling($controller)->blockToStopContainerIteratorEngineIs = function($engine, $block) use ($controller, & $stopBlock) {
					$stopBlock = $block;

					$engine->controllerOfContainerIteratorIs($controller);
				}
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum4, $position1, $controller)
							->once
						->withIdenticalArguments($datum3, $position2, $controller)
							->once
						->withIdenticalArguments($datum2, $position3, $controller)
							->once
						->withIdenticalArguments($datum1, $position4, $controller)
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

				$this->calling($payload)->containerIteratorControllerForDatumAtPositionIs = function($value, $position, $controller) {
					$controller->nextIterationsAreUseless();
				},

				$this->calling($controller)->nextIterationsAreUseless = function() use (& $stopBlock) {
					$stopBlock->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum4, $position5, $controller)
							->once
						->withIdenticalArguments($datum3, $position6, $controller)
							->never
						->withIdenticalArguments($datum2, $position7, $controller)
							->never
						->withIdenticalArguments($datum1, $position8, $controller)
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

				$this->calling($controller)->nextIterationsAreUseless->doesNothing,

				$this->newTestedInstance($controller, $integerGenerator)
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum4)
							->twice
						->withIdenticalArguments($datum3)
							->once
						->withIdenticalArguments($datum2)
							->once
						->withIdenticalArguments($datum1)
							->once
		;
	}
}
