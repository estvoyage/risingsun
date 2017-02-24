<?php namespace estvoyage\risingsun\tests\units\block\proxy\oboolean;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class recipient extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$recipient = new mockOfOBoolean\recipient,
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->newTestedInstance($recipient, $oboolean)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($recipient, $oboolean))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($oboolean)
							->once
		;
	}
}
