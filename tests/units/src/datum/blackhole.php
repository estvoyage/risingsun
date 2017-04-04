<?php namespace estvoyage\risingsun\tests\units\datum;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nstring as mockOfNString, datum as mockOfDatum };

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum')
		;
	}

	function testRecipientOfNStringIs()
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfNStringIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->never
		;
	}

	function testRecipientOfDatumWithNStringIs()
	{
		$this
			->given(
				$value = uniqid(),
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfDatumWithNStringIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumLengthIs()
	{
		$this
			->given(
				$recipient = new mockOfDatum\length\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->newTestedInstance->recipientOfDatumLengthIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumLengthIs')
						->never
		;
	}
}
