<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, container };
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger };

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine')
		;
	}

	function testConstructor()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new container\iterator\engine\controller\block, new ointeger\generator\operation\binary\addition));
	}

	function testValuesForContainerIteratorPayloadIs()
	{
		$this
			->given(
				$generator = new mockOfOInteger\generator,
				$controller = new mockOfContainer\iterator\engine\controller,
				$payload = new mockOfContainer\iterator\payload,
				$payloadValue1 = uniqid(),
				$payloadValue2 = rand(- PHP_INT_MAX, PHP_INT_MAX),
				$payloadValue3 = M_PI
			)
			->if(
				$this->newTestedInstance($controller, $generator)
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $payloadValue1, $payloadValue2, $payloadValue3))
					->isEqualTo($this->newTestedInstance($controller, $generator))
				->mock($payload)
					->receive('containerIteratorEngineControllerOfValueAtPositionIs')
						->never

			->given(
				$controllerForPaylaod = new mockOfContainer\iterator\engine\controller
			)
			->if(
				$this->calling($controller)->recipientOfContainerIteratorEngineControllerWithBlockIs = function($block, $recipient) use ($controllerForPaylaod, & $controlBlock) {
					$controlBlock = $block;

					$recipient->containerIteratorEngineControllerIs($controllerForPaylaod);
				}
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $payloadValue1, $payloadValue2, $payloadValue3))
					->isEqualTo($this->newTestedInstance($controller, $generator))
				->mock($payload)
					->receive('containerIteratorEngineControllerOfValueAtPositionIs')
						->never

			->given(
				$i = 0,
				$values = null,
				$position1 = new mockOfOInteger,
				$position2 = new mockOfOInteger,
				$position3 = new mockOfOInteger
			)
			->if(
				$this->calling($generator)->recipientOfOIntegerIs = function($recipient) use ($position1, $position2, $position3, & $i) {
					$i += 1;

					$recipient->ointegerIs(${'position' . $i});
				},
				$this->calling($payload)->containerIteratorEngineControllerOfValueAtPositionIs = function($value) use (& $values) {
					$values[] = $value;
				}
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $payloadValue1, $payloadValue2, $payloadValue3))
					->isEqualTo($this->newTestedInstance($controller, $generator))
				->mock($payload)
					->receive('containerIteratorEngineControllerOfValueAtPositionIs')
						->withArguments($payloadValue1, $position1, $controllerForPaylaod)
							->once
						->withArguments($payloadValue2, $position2, $controllerForPaylaod)
							->once
						->withArguments($payloadValue3, $position3, $controllerForPaylaod)
							->once
				->array($values)
					->isEqualTo([ $payloadValue1, $payloadValue2, $payloadValue3 ])

			->given(
				$i = 0,
				$values = null
			)
			->if(
				$this->calling($controllerForPaylaod)->remainingIterationsInContainerIteratorEngineAreUseless = function() use (& $controlBlock) {
					$controlBlock->blockArgumentsAre();
				},

				$this->calling($payload)->containerIteratorEngineControllerOfValueAtPositionIs = function($value, $position, $controller) use (& $values) {
					$values[] = $value;

					$controller->remainingIterationsInContainerIteratorEngineAreUseless();
				}
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $payloadValue1, $payloadValue2, $payloadValue3))
					->isEqualTo($this->newTestedInstance($controller, $generator))
				->mock($payload)
					->receive('containerIteratorEngineControllerOfValueAtPositionIs')
						->withArguments($payloadValue1, $position1, $controllerForPaylaod)
							->twice
						->withArguments($payloadValue2, $position2, $controllerForPaylaod)
							->once
						->withArguments($payloadValue3, $position3, $controllerForPaylaod)
							->once
				->array($values)
					->isEqualTo([ $payloadValue1 ])
		;
	}
}
