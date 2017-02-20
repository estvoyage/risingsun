<?php namespace estvoyage\risingsun\tests\units\datum\container\payload\output;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger, container as mockOfContainer, output as mockOfOutput };

class line extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\payload')
		;
	}

	function testContainerIteratorControllerForDatumAtPositionIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\controller,
				$output = new mockOfOutput,
				$operation = new mockOfDatum\operation\binary
			)
			->if(
				$this->newTestedInstance($output, $operation)
			)
			->then
				->object($this->testedInstance->containerIteratorControllerForDatumAtPositionIs($datum, $position, $controller))
					->isEqualTo($this->newTestedInstance($output, $operation))
				->mock($output)
					->receive('outputLineIsOperationOnData')
						->withArguments($operation, $position, $datum)
							->once
		;
	}
}
