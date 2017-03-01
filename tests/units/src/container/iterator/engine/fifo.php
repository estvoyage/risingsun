<?php namespace estvoyage\risingsun\tests\units\container\iterator\engine;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\container as mockOfContainer;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\engine')
		;
	}

	function testControllerOfContainerIteratorIs()
	{
		$this
			->given(
				$controller = new mockOfContainer\iterator\controller
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->controllerOfContainerIteratorIs($controller))
					->isEqualTo($this->newTestedInstance)
		;
	}
}
