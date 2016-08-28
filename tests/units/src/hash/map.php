<?php namespace estvoyage\risingsun\tests\units\hash;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\hash,
	mock\estvoyage\risingsun\hash as mockOfHash
;

class map extends units\test
{
	function testRecipientOfHashValueAtKeyIs()
	{
		$this
			->given(
				$key = new hash\key(uniqid()),
				$recipient = new mockOfHash\value\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHashValueAtKeyIs($key, $recipient))
					->isEqualTo($this->newTestedInstance)

			->given(
				$value = uniqid(),
				$hashValue = new mockOfHash\value
			)
			->if(
				$this->calling($hashValue)->recipientOfHashValueContentsIs = function($recipient) use ($key, $value) {
					$recipient->hashValueContentsIs($key, $value);
				},
				$this->newTestedInstance($hashValue)
					->recipientOfHashValueAtKeyIs($key, $recipient)
			)
			->then
				->mock($recipient)
					->receive('hashHasValue')
						->withArguments($value)
							->once
		;
	}

	function testHashValueContentsIs()
	{
		$this
			->given(
				$key = new hash\key(uniqid()),
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->hashValueContentsIs($key, $value))
					->isEqualTo($this->newTestedInstance)
		;
	}

	function testRecipientOfHashWithValueIs()
	{
		$this
			->given(
				$value = new mockOfHash\value,
				$recipient = new mockOfHash\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfHashWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('hashIs')
						->withArguments($this->newTestedInstance($value))
							->once
		;
	}
}
