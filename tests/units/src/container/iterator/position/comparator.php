<?php namespace estvoyage\risingsun\tests\units\container\iterator\position;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, container as mockOfContainer };

class comparator extends units\test
{
	function testIteratorControllerIForPositionIs()
	{
		$this
			->given(
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller,
				$comparison = new mockOfOInteger\comparison\unary
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->iteratorControllerForPositionIs($position, $controller))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($controller)
					->receive('nextContainerValuesAreUseless')
						->never

			->if(
				$this->calling($comparison)->blockForComparisonWithOIntegerIs = function($ointeger, $block) {
					$block->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->iteratorControllerForPositionIs($position, $controller))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($controller)
					->receive('nextContainerValuesAreUseless')
						->once
		;
	}
}
