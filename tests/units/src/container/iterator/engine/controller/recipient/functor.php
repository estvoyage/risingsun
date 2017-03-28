<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine\controller\recipient;

require __DIR__ . '/../../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\container as mockOfContainer;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine\controller\recipient')
		;
	}

	function testContainerIteratorEngineControllerIs()
	{
		$this
			->given(
				$controller = new mockOfContainer\iterator\engine\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerIs($controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $controller ])
		;
	}
}
