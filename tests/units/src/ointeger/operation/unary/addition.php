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

	function test__construct()
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

	function testRecipientOfOperationWithOIntegerIs()
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
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$addendValue = 1
			)
			->if(
				$this->calling($addend)->recipientOfNIntegerIs = function($recipient) use ($addendValue) {
					$recipient->nintegerIs($addendValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($addend, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$ointegerValue = 2
			)
			->if(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use ($ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($addend, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$addition = new mockOfOInteger
			)
			->if(
				$this->calling($ointeger)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($addition) {
					if ($value == 3)
					{
						$recipient->ointegerIs($addition);
					}
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient))
					->isEqualTo($this->newTestedInstance($addend, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($addition)
							->once
		;
	}
}
