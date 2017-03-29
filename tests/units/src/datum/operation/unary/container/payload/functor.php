<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\container\payload;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ container as mockOfContainer, datum as mockOfDatum };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary\container\payload')
		;
	}

	function testContainerIteratorEngineControllerForUnaryDatumOperationAtPositionIs()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\unary,
				$position = new mockOfContainer\iterator\position,
				$controller = new mockOfContainer\iterator\engine\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs($operation, $position, $controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $operation, $position, $controller ])
		;
	}
}
