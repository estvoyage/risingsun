<?php namespace estvoyage\risingsun\tests\units\comparison\binary\conjunction;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, container as mockOfContainer };

class controller extends units\test
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
				$recipient = new mockOfComparison\recipient,
				$engine = new mockOfContainer\iterator\engine
			)
			->if(
				$this->newTestedInstance($recipient)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineIs($engine))
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($engine)
					->receive('controllerOfContainerIteratorIs')
						->withArguments($this->newTestedInstance($recipient, $engine))
							->once
		;
	}

	function testContainerIteratorEngineHasNoMoreIteration()
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($recipient)
			)
			->then
				->object($this->testedInstance->containerIteratorHasNoMoreIteration())
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('comparisonIsFalse')
						->never
				->mock($recipient)
					->receive('comparisonIsTrue')
						->once
		;
	}

	function testRemainingIterationsAreUseless()
	{
		$this
			->given(
				$recipient = new mockOfComparison\recipient
			)
			->if(
				$this->newTestedInstance($recipient)
			)
			->then
				->object($this->testedInstance->remainingIterationsAreUseless())
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('comparisonIsFalse')
						->once
				->mock($recipient)
					->receive('comparisonIsTrue')
						->never
		;
	}
}
