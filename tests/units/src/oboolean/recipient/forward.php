<?php namespace estvoyage\risingsun\tests\units\oboolean\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class forward extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\oboolean\recipient')
		;
	}

	function testObooleanIs()
	{
		$this
			->given(
				$recipient = new mockOfOBoolean\recipient,
				$forward = new mockOfOBoolean,
				$this->newTestedInstance($recipient, $forward)
			)
			->if(
				$oboolean = new oboolean\ko
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($recipient, $forward))
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$oboolean = new oboolean\ok
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($recipient, $forward))
				->mock($recipient)
					->receive('obooleanIs')
						->withIdenticalArguments($forward)
							->once
		;
	}
}
