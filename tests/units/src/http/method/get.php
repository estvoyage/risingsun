<?php namespace estvoyage\risingsun\tests\units\http\method;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nstring as mockOfNString, http as mockOfHttp, oboolean as mockOfOBoolean };

class get extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\method')
		;
	}

	function testRecipientOfHttpMethodValueIs()
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHttpMethodValueIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('GET')
							->once
		;
	}
}
