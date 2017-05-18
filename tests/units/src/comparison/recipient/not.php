<?php namespace estvoyage\risingsun\tests\units\comparison\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\comparison as mockOfComparison;

class not extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testNbooleanIs()
	{
		$this
			->given(
				$this->newTestedInstance($recipient = new mockOfComparison\recipient)
			)

			->if(
				$this->testedInstance->nbooleanIs(false)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(true)
							->once

			->if(
				$this->testedInstance->nbooleanIs(true)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($recipient)
					->receive('nbooleanIs')
						->withArguments(false)
							->once
		;
	}
}
