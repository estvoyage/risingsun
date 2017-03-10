<?php namespace estvoyage\risingsun\tests\units\nstring\operation\binary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ nstring as mockOfNString, ointeger as mockOfOInteger };

class right extends units\test
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
				$length = new mockOfOInteger\unsigned,
				$firstOperand = 'a',
				$secondOperand = 'b',
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($length)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('nstringIs')
						->never

			->given(
				$lengthValue = 1
			)
			->if(
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) use (& $lengthValue) {
					$recipient->nintegerIs($lengthValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('a')
							->once

			->if(
				$lengthValue = 2
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('ab')
							->once

			->if(
				$lengthValue = 10
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('abbbbbbbbb')
							->once

			->if(
				$secondOperand = 'cdef'
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnNStringsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($length))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('acdefcdefc')
							->once
		;
	}
}
