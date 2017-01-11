<?php namespace estvoyage\risingsun\tests\units\ostring\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\{ risingsun, risingsun\tests\units };
use mock\estvoyage\risingsun\ostring as mockOfOString;

class revert extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ostring\operation\unary')
		;
	}

	function testRecipientForStringOperandIs()
	{
		$this
			->given(
				$operandValue = 'foobar',

				$operand = new mockOfOString,
				$this->calling($operand)->recipientOfStringValueIs = function($recipient) use ($operandValue) {
					$recipient->stringValueIs($operandValue);
				},

				$recipient = new mockOfOString\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientForStringOperandIs($operand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ostringIs')
						->withArguments(new risingsun\ostring('raboof'))
							->once
		;
	}
}
