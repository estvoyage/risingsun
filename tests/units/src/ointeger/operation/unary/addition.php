<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, block, comparison };
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
				$addend = new mockOfOInteger,
				$template = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($addend, $template)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($addend, $template, new block\blackhole))
		;
	}

	function testRecipientOfOperationWithOIntegerIs()
	{
		$this
			->given(
				$this->newTestedInstance($addend = new mockOfOInteger, $template = new mockOfOInteger, $overflow = new mockOfBlock),
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($addend, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($addend)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($addend, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($addend, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$addition = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($addition) {
					(new comparison\unary\equal(3))
						->recipientOfComparisonWithOperandIs(
							$value,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $addition)
								{
									$recipient->ointegerIs($addition);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($addend, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($addition)
							->once
		;
	}
}
