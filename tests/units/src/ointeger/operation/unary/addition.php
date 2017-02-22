<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\unary')
		;
	}

	function testWithoutOverflow()
	{
		$this
			->given(
				$addend = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($addend)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($addend, new block\blackhole))
		;
	}

	function testRecipientOfOperationWithIntegerIs()
	{
		$this
			->given(
				$addend = new mockOfOInteger,
				$overflow = new mockOfBlock,
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance($addend, $overflow)
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($addend, $overflow))
				->mock($ointeger)
					->receive('recipientOfOIntegerOperationWithOIntegerIs')
						->withArguments(new ointeger\operation\binary\addition($overflow), $addend, $recipient)
							->once
		;
	}
}
