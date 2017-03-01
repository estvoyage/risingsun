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

	function testContainerIteratorEngineIs()
	{
		$this
			->given(
				$engine = new mockOfContainer\iterator\engine
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->newTestedInstance->containerIteratorEngineIs($engine))->isEqualTo($this->newTestedInstance)
		;
	}

	function testRemainingIterationsAreUseless()
	{
		$this->object($this->newTestedInstance->remainingIterationsAreUseless())->isEqualTo($this->newTestedInstance);
	}

	function testContainerIteratorEngineHasNoMoreIteration()
	{
		$this->object($this->newTestedInstance->containerIteratorEngineHasNoMoreIteration())->isEqualTo($this->newTestedInstance);
	}
}
