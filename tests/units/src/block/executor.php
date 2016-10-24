<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	mock\estvoyage\risingsun\block as mockOfBlock,
	mock\estvoyage\risingsun\error as mockOfError
;

class executor extends units\test
{
	function testIfError()
	{
		$this
			->given(
				$errorGenerator = new mockOfBlock,
				$errorManager = new mockOfError\manager
			)
			->if(
				$this->newTestedInstance($errorGenerator)
			)
			->then
				->object($this->testedInstance->errorManagerIs($errorManager))
					->isEqualTo($this->newTestedInstance($errorGenerator))
				->mock($errorManager)
					->receive('errorIs')
						->never

			->given(
				$errorMessage = uniqid()
			)
			->if(
				$this->calling($errorGenerator)->blockArgumentsAre = function() use ($errorMessage) { trigger_error($errorMessage); },
				$this->newTestedInstance($errorGenerator)
			)
			->then
				->object($this->testedInstance->errorManagerIs($errorManager))
					->isEqualTo($this->newTestedInstance($errorGenerator))
				->mock($errorManager)
					->receive('errorIs')
						->withArguments(new risingsun\error($errorMessage))
							->once
		;
	}
}
