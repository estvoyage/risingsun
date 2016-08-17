<?php namespace estvoyage\risingsun\tests\units\output\stream\formater\abbreviation;

require __DIR__ . '/../../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\output,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class notAvailable extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\stream\formater')
		;
	}

	function testOutputIs()
	{
		$this
			->given(
				$output = new mockOfOutput
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->outputIs($output))->isTestedInstance
				->mock($output)
					->receive('outputStreamIs')
						->withArguments(new output\stream('n/a'))
							->once
		;
	}
}
