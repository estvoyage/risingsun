<?php namespace estvoyage\risingsun\tests\units\output\stream\formater\duration;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ time, output, tests\units };
use mock\estvoyage\risingsun\{ time as mockOfTime, output as mockOfOutput };

class secondAndMicroSecond extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output\formater\duration')
		;
	}

	function testOutputForDurationIs()
	{
		$this
			->given(
				$output = new mockOfOutput,
				$defaultSecond = new output\stream(uniqid()),
				$defaultMicro = new output\stream(uniqid()),

				$duration = new mockOfTime\duration
			)
			->if(
				$this->newTestedInstance($defaultSecond, $defaultMicro)
			)
			->then
				->object($this->testedInstance->outputForDurationIs($duration, $output))
					->isEqualTo($this->newTestedInstance($defaultSecond, $defaultMicro))
				->mock($output)
					->receive('outputStreamIs')
						->withArguments(new output\stream($defaultSecond . '.' . $defaultMicro))
							->once

			->given(
				$numberOfSecond = new time\second(rand(1, PHP_INT_MAX)),
				$this->calling($duration)->recipientOfNumberOfSecondIs = function(time\second\recipient $aRecipient) use ($numberOfSecond) {
					$aRecipient->numberOfSecondIs($numberOfSecond);
				},

				$numberOfMicroSecond = new time\second\micro(rand(1, PHP_INT_MAX)),
				$this->calling($duration)->recipientOfNumberOfMicroSecondIs = function(time\second\micro\recipient $aRecipient) use ($numberOfMicroSecond) {
					$aRecipient->numberOfMicroSecondIs($numberOfMicroSecond);
				}
			)
			->if(
				$this->newTestedInstance($defaultSecond, $defaultMicro)
			)
			->then
				->object($this->testedInstance->outputForDurationIs($duration, $output))
					->isEqualTo($this->newTestedInstance($defaultSecond, $defaultMicro))
				->mock($output)
					->receive('outputStreamIs')
						->withArguments(new output\stream($numberOfSecond . '.' . $numberOfMicroSecond))
							->once
		;
	}
}
