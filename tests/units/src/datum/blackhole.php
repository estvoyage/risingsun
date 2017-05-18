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
				$this->newTestedInstance,
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->testedInstance->recipientOfNStringIs($recipient)
			)
			->then
				->object($this->testedInstance)
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
				$this->newTestedInstance,
				$value = uniqid(),
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumWithNStringIs($value, $recipient)
			)
			->then
				->object($this->testedInstance)
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
				$this->newTestedInstance,
				$recipient = new mockOfDatum\length\recipient
			)
			->if(
				$this->newTestedInstance->recipientOfDatumLengthIs($recipient)
			)
			->then
				->object($this->newTestedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumLengthIs')
						->never
		;
	}
}
