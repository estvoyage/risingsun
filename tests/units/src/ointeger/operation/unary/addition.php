<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\unary')
		;
	}

	function testRecipientOfOperationWithIntegerIs()
	{
		$this
			->given(
				$increment = new mockOfOInteger,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance($increment)
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($increment))
				->mock($ointeger)
					->receive('recipientOfOIntegerOperationWithOIntegerIs')
						->withArguments(new ointeger\operation\binary\addition, $increment, $recipient)
							->once
		;
	}
}
