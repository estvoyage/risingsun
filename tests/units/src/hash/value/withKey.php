<?php namespace estvoyage\risingsun\tests\units\hash\value;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\hash,
	mock\estvoyage\risingsun\hash as mockOfHash
;

class withKey extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\hash\value')
		;
	}

	function testRecipientOfHashValueContentsIs()
	{
		$this
			->given(
				$value = uniqid(),
				$key = new hash\key(uniqid()),
				$recipient = new mockOfHash\value\contents\recipient
			)
			->if(
				$this->newTestedInstance($value, $key)
			)
			->then
				->object($this->testedInstance->recipientOfHashValueContentsIs($recipient))
					->isEqualTo($this->newTestedInstance($value, $key))
				->mock($recipient)
					->receive('hashValueContentsHasKey')
						->withIdenticalArguments($value, $key)
							->once
		;
	}
}
