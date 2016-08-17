<?php namespace estvoyage\risingsun\tests\units\output\stream\formater;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class endOfLine extends units\test
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
					->receive('endOfLine')
						->once
		;
	}
}
