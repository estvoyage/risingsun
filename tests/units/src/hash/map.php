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
					$recipient->hashValueContentsHasKey($value, $key);
				},
				$this->newTestedInstance($hashValue)
					->recipientOfHashValueAtKeyIs($key, $recipient)
			)
			->then
				->mock($recipient)
					->receive('hashKeyHasValue')
						->withArguments($value)
							->once
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
							->never

			->given(
				$valueContents = uniqid(),
				$valueKey = new hash\key(uniqid()),

				$this->calling($value)->recipientOfHashValueContentsIs = function($recipient) use ($valueContents, $valueKey) {
					$recipient->hashValueContentsHasKey($valueContents, $valueKey);
				}
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
