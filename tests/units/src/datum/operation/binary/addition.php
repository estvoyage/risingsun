<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfOperationOnDataIs()
	{
		$this
			->given(
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->never

			->given(
				$firstDatumValue = 'foo'
			)
			->if(
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) use ($firstDatumValue) {
					$recipient->nstringIs($firstDatumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->never

			->given(
				$secondDatumValue = 'bar'
			)
			->if(
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) use ($secondDatumValue) {
					$recipient->nstringIs($secondDatumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('foobar')
							->once
		;
	}
}
