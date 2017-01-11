<?php namespace estvoyage\risingsun\tests\units\ostring\operation\binary;

require __DIR__ . '/../../../runner.php';

use estvoyage\{ risingsun, risingsun\tests\units };
use mock\estvoyage\risingsun\ostring as mockOfOString;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ostring\operation\binary')
		;
	}

	function testRecipientForStringOperandAndStringOperandIs()
	{
		$this
			->given(
				$string1 = new mockOfOString,
				$this->calling($string1)->recipientOfStringValueIs = function($recipient) {
					$recipient->stringValueIs('foo');
				},

				$string2 = new mockOfOString,
				$this->calling($string2)->recipientOfStringValueIs = function($recipient) {
					$recipient->stringValueIs('bar');
				},

				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientForStringOperandAndStringOperandIs($string1, $string2, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->withArguments(new risingsun\ostring('foobar'))
							->once
		;
	}
}
