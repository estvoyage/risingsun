<?php namespace estvoyage\risingsun\tests\units\container\iterator\controller;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, container as mockOfContainer };

class stopper extends units\test
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
				$block = new mockOfBlock,
				$engine = new mockOfContainer\iterator\engine
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->blockToStopContainerIteratorEngineIs($engine, $block))
					->isEqualTo($this->newTestedInstance)
				->mock($engine)
					->receive('controllerOfContainerIteratorIs')
						->withArguments($this->newTestedInstance($block))
							->once
		;
	}

	function testNextContainerValuesAreUseless()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->nextContainerValuesAreUseless())
					->isEqualTo($this->newTestedInstance)

			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->nextContainerValuesAreUseless())
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
