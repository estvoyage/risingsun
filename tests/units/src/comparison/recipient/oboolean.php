<?php namespace estvoyage\risingsun\tests\units\comparison\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class oboolean extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testNBooleanIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOBoolean, $recipient = new mockOfOBoolean\recipient)
			)
			->if(
				$this->testedInstance->nbooleanIs(false)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $recipient))
				->mock($template)
					->receive('recipientOfOBooleanWithNBooleanIs')
						->withArguments(false, $recipient)
							->once
		;
	}
}
