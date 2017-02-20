<?php namespace estvoyage\risingsun\tests\units\container\iterator\controller;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ container as mockOfContainer, block as mockOfBlock };

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\iterator\controller')
		;
	}

	function testBlockToStopContainerIteratorEngineIs()
	{
		$this
			->given(
				$engine = new mockOfContainer\iterator\engine,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->newTestedInstance->nextIterationsAreUseless())->isEqualTo($this->newTestedInstance)
		;
	}

	function testNextIterationsAreUseless()
	{
		$this->object($this->newTestedInstance->nextIterationsAreUseless())->isEqualTo($this->newTestedInstance);
	}
}
