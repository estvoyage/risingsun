<?php namespace estvoyage\risingsun\tests\units\container\iterator\controller;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\container as mockOfContainer;

class stopper extends units\test
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
				->object($this->testedInstance->containerIteratorEngineIs($engine))
					->isEqualTo($this->newTestedInstance)
				->mock($engine)
					->receive('controllerOfContainerIteratorIs')
						->withArguments($this->newTestedInstance($engine))
							->once
		;
	}

	function testRemainingIterationsAreUseless()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->remainingIterationsAreUseless())
					->isEqualTo($this->newTestedInstance)

			->given(
				$engine = new mockOfContainer\iterator\engine
			)
			->if(
				$this->newTestedInstance($engine)
			)
			->then
				->object($this->testedInstance->remainingIterationsAreUseless())
					->isEqualTo($this->newTestedInstance($engine))
				->mock($engine)
					->receive('remainingIterationsAreUseless')
						->withArguments()
							->once
		;
	}

	function testContainerIteratorEngineHasNoMoreIteration()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->containerIteratorEngineHasNoMoreIteration())
					->isEqualTo($this->newTestedInstance)
		;
	}
}
