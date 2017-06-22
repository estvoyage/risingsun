<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, comparison, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class division extends units\test
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
				$divisor = new mockOfOInteger,
				$template = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($divisor, $template)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($divisor, $template, new block\blackhole))
		;
	}

	function testRecipientOfOperationWithOIntegerIs()
	{
		$this
			->given(
				$this->newTestedInstance($divisor = new mockOfOInteger, $template = new mockOfOInteger, $divisionByZero = new mockOfBlock),
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($divisor, $template, $divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($divisor)->recipientOfNIntegerIs = function($recipient) { $recipient->nintegerIs(2); },

				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) { $recipient->nintegerIs(3); },

				$quotient = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($quotient) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							1,
							new comparison\recipient\ok(
								new block\functor(
									function() use ($quotient, $recipient) {
										$recipient->ointegerIs($quotient);
									}
								)
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
					->isEqualTo($this->newTestedInstance($divisor, $template, $divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($quotient)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($divisor)->recipientOfNIntegerIs = function($recipient) { $recipient->nintegerIs(0); }
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($divisor, $template, $divisionByZero))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($quotient)
							->once
				->mock($divisionByZero)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
