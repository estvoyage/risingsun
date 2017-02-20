<?php namespace estvoyage\risingsun\tests\units\container\payload\output;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger, container as mockOfContainer, output as mockOfOutput };

class line extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\container\payload')
		;
	}

	function testContainerIteratorControllerForValueAtPositionIs()
	{
		$this
			->given(
				$value = new mockOfDatum,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller,
				$output = new mockOfOutput,
				$operation = new mockOfDatum\operation
			)
			->if(
				$this->newTestedInstance($output, $operation)
			)
			->then
				->object($this->testedInstance->containerIteratorControllerForValueAtPositionIs($value, $position, $controller))
					->isEqualTo($this->newTestedInstance($output, $operation))
				->mock($output)
					->receive('outputLineIsOperationOnData')
						->withArguments($operation, $position, $value)
							->once
		;
	}
}
