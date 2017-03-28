<?php namespace estvoyage\risingsun\tests\units\container\iterator\payload;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\payload')
		;
	}

	function testContainerIteratorEngineControllerOfValueAtPositionIs()
	{
		$this
			->given(
				$value = uniqid(),
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerOfValueAtPositionIs($value, $position, $controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $value, $position, $controller ])
		;
	}

}
