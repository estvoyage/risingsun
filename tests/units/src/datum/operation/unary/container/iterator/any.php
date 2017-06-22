<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\container\iterator;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ container as mockOfContainer, datum as mockOfDatum, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary\container\iterator')
		;
	}

	function testUnaryDatumOperationsForPayloadAre()
	{
		$this
			->given(
				$this->newTestedInstance($engine = new mockOfContainer\iterator\engine),
				$payload = new mockOfDatum\operation\unary\container\payload,
				$operation = new mockOfDatum\operation\unary
			)
			->if(
				$this->testedInstance->unaryDatumOperationsForPayloadAre($payload, $operation)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs')
						->never

			->given(
				$controller = new mockOfContainer\iterator\engine\controller,
				$position = new mockOfOInteger,
				$this->calling($engine)->valuesForContainerIteratorPayloadIs = function($payload, ... $values) use ($controller, $position) {
					$payload->containerIteratorEngineControllerOfValueAtPositionIs(current($values), $position, $controller);
				}
			)
			->if(
				$this->testedInstance->unaryDatumOperationsForPayloadAre($payload, $operation)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs')
						->withArguments($operation, $position, $controller)
							->once
		;
	}
}
