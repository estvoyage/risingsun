<?php namespace estvoyage\risingsun\tests\units\output\stream\formater;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class aggregator extends units\test
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

			->given(
				$formater = new mockOfOutput\stream\formater
			)
			->if(
				$this->newTestedInstance($formater)->outputIs($output)
			)
			->then
				->mock($formater)
					->receive('outputIs')
						->withIdenticalArguments($output)
							->once

			->given(
				$otherFormater = new mockOfOutput\stream\formater
			)
			->if(
				$this->newTestedInstance($formater, $otherFormater)->outputIs($output)
			)
			->then
				->mock($otherFormater)
					->receive('outputIs')
						->withIdenticalArguments($output)
							->once
		;
	}
}
