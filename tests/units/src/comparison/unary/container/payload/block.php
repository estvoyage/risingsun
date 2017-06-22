<?php namespace estvoyage\risingsun\tests\units\comparison\unary\container\payload;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ comparison as mockOfComparison, container as mockOfContainer, block as mockOfBlock, ointeger as mockOfOInteger };

class block extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\unary\container\payload')
		;
	}

	function testContainerIteratorEngineControllerForUnaryComparisonAtPositionIs()
	{
		$this
			->given(
				$comparison = new mockOfComparison\unary,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller,
				$this->newTestedInstance($block = new mockOfBlock)
			)
			->if(
				$this->testedInstance->containerIteratorEngineControllerForUnaryComparisonAtPositionIs($comparison, $position, $controller)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($comparison, $position, $controller)
							->once
		;
	}
}
