<?php namespace estvoyage\risingsun\tests\units\nstring\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\nstring as mockOfNString;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\nstring\operation\binary')
		;
	}

	function testRecipientOfOperationOnNStringsIs()
	{
		$this
			->given(
				$firstOperand = 'foo',
				$secondOperand = 'bar',
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('foobar')
							->once
		;
	}
}
