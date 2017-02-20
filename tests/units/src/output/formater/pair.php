<?php namespace estvoyage\risingsun\tests\units\output\formater;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, output as mockOfOutput, ostring as mockOfOString };

class pair extends units\test
{
	function testOutputIs()
	{
		$this
			->given(
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$operation = new mockOfDatum\operation\binary,
				$output = new mockOfOutput
			)
			->if(
				$this->newTestedInstance($firstDatum, $secondDatum, $operation)
			)
			->then
				->object($this->testedInstance->outputIs($output))
					->isEqualTo($this->newTestedInstance($firstDatum, $secondDatum, $operation))
				->mock($output)
					->receive('outputLineIsOperationOnData')
						->withIdenticalArguments($operation, $firstDatum, $secondDatum)
							->once
		;
	}
}
