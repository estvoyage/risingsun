<?php namespace estvoyage\risingsun\tests\units\container\iterator;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, container, oboolean, ointeger\generator };
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger, datum as mockOfDatum, comparison as mockOfComparison };

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\iterator')
			->implements('estvoyage\risingsun\comparison\binary\container\iterator')
		;
	}

	function testConstructor()
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
				$this->calling($controller)->containerIteratorEngineIs = function($anEngine) use ($controller, & $engine) {
					$engine = $anEngine;

					$engine->controllerOfContainerIteratorIs($controller);
				}
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum1, $position1, $controller)
							->once
						->withIdenticalArguments($datum2, $position2, $controller)
							->once
						->withIdenticalArguments($datum3, $position3, $controller)
							->once
						->withIdenticalArguments($datum4, $position4, $controller)
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
					$controller->remainingIterationsAreUseless();
				},

				$this->calling($controller)->remainingIterationsAreUseless = function() use (& $engine) {
					$engine->remainingIterationsAreUseless();
				}
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum1, $datum2, $datum3, $datum4))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('containerIteratorControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum1, $position5, $controller)
							->once
						->withIdenticalArguments($datum2, $position6, $controller)
							->never
						->withIdenticalArguments($datum3, $position7, $controller)
							->never
						->withIdenticalArguments($datum4, $position8, $controller)
							->never
		;
	}

	function testBinaryComparisonsForPayloadWithControllerAre()
	{
		$this
			->given(
				$payload = new mockOfComparison\binary\container\payload,
				$controller = new mockOfContainer\iterator\controller,
				$integerGenerator = new mockOfOInteger\generator
			)
			->if(
				$this->newTestedInstance($controller, $integerGenerator)
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadWithControllerAre($payload, $controller))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('iteratorControllerForBinaryComparisonAtPositionIs')
						->never

			->given(
				$comparison1 = new mockOfComparison\binary,
				$position1 = new mockOfOInteger,

				$comparison2 = new mockOfComparison\binary,
				$position2 = new mockOfOInteger,

				$comparison3 = new mockOfComparison\binary,
				$position3 = new mockOfOInteger
			)
			->if(
				$this->calling($integerGenerator)->recipientOfOIntegerIs[1] = function($recipient) use ($position1) {
					$recipient->ointegerIs($position1);
				},

				$this->calling($integerGenerator)->recipientOfOIntegerIs[2] = function($recipient) use ($position2) {
					$recipient->ointegerIs($position2);
				},

				$this->calling($integerGenerator)->recipientOfOIntegerIs[3] = function($recipient) use ($position3) {
					$recipient->ointegerIs($position3);
				}
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadWithControllerAre($payload, $controller, $comparison1, $comparison2, $comparison3))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('iteratorControllerForBinaryComparisonAtPositionIs')
						->never

			->if(
				$this->calling($controller)->containerIteratorEngineIs = function($anEngine) use ($controller, & $engine) {
					$engine = $anEngine;
					$engine->controllerOfContainerIteratorIs($controller);
				}
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadWithControllerAre($payload, $controller, $comparison1, $comparison2, $comparison3))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('iteratorControllerForBinaryComparisonAtPositionIs')
						->withIdenticalArguments($comparison1, $position1, $controller)
							->once
						->withIdenticalArguments($comparison2, $position2, $controller)
							->once
						->withIdenticalArguments($comparison3, $position3, $controller)
							->once

			->given(
				$position5 = new mockOfOInteger,
				$position6 = new mockOfOInteger,
				$position7 = new mockOfOInteger
			)
			->if(
				$this->calling($integerGenerator)->recipientOfOIntegerIs[4] = function($recipient) use ($position5) {
					$recipient->ointegerIs($position5);
				},

				$this->calling($integerGenerator)->recipientOfOIntegerIs[5] = function($recipient) use ($position6) {
					$recipient->ointegerIs($position6);
				},

				$this->calling($integerGenerator)->recipientOfOIntegerIs[6] = function($recipient) use ($position7) {
					$recipient->ointegerIs($position7);
				},

				$this->calling($payload)->iteratorControllerForBinaryComparisonAtPositionIs = function($value, $position, $controller) {
					$controller->remainingIterationsAreUseless();
				},

				$this->calling($controller)->remainingIterationsAreUseless = function() use (& $engine) {
					$engine->remainingIterationsAreUseless();
				}
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadWithControllerAre($payload, $controller, $comparison1, $comparison2, $comparison3))
					->isEqualTo($this->newTestedInstance($controller, $integerGenerator))
				->mock($payload)
					->receive('iteratorControllerForBinaryComparisonAtPositionIs')
						->withIdenticalArguments($comparison1, $position5, $controller)
							->once
						->withIdenticalArguments($comparison2, $position6, $controller)
							->never
						->withIdenticalArguments($comparison3, $position7, $controller)
							->never
		;
	}
}
