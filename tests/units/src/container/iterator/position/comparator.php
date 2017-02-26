<?php namespace estvoyage\risingsun\tests\units\container\iterator\position;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, container as mockOfContainer, datum as mockOfDatum };

class comparator extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\payload')
		;
	}

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
					->receive('nextIterationsAreUseless')
						->never

			->if(
				$this->calling($comparison)->recipientOfOIntegerComparisonWithOIntegerIs = function($ointeger, $recipient) {
					$recipient->obooleanIs(new oboolean\ok);
				}
			)
			->then
				->object($this->testedInstance->iteratorControllerForPositionIs($position, $controller))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($controller)
					->receive('nextIterationsAreUseless')
						->once
		;
	}

	function testContainerIteratorControllerForDatumAtPositionIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller,
				$comparison = new mockOfOInteger\comparison\unary
			)
			->if(
				$this->newTestedInstance($comparison)
			)
			->then
				->object($this->testedInstance->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($controller)
					->receive('nextIterationsAreUseless')
						->never

			->if(
				$this->calling($comparison)->recipientOfOIntegerComparisonWithOIntegerIs = function($ointeger, $recipient) {
					$recipient->obooleanIs(new oboolean\ok);
				}
			)
			->then
				->object($this->testedInstance->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller))
					->isEqualTo($this->newTestedInstance($comparison))
				->mock($controller)
					->receive('nextIterationsAreUseless')
						->once
		;
	}
}
