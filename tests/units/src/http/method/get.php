<?php namespace estvoyage\risingsun\tests\units\http\method;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum };
use mock\estvoyage\risingsun\{ nstring as mockOfNString, datum as mockOfDatum };

class get extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\method')
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
						->withArguments('GET')
							->once
		;
	}

	function testRecipientOfDatumWithNStringIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumWithNStringIs(uniqid(), $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}

	function testRecipientOfDatumFromDatumIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumFromDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('datumIs')
						->never
		;
	}
}
