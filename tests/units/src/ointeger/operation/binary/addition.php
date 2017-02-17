<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean\factory, block\functor };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function testRecipientOfOperationOnIntegersAre()
	{
		$this
			->given(
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$addition = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfOIntegerWithValueIs = function($ninteger, $recipient) use ($addition) {
					factory::areEquals($ninteger, 3)
						->blockForTrueIs(
							new functor(
								function() use ($addition, $recipient)
								{
									$recipient->ointegerIs($addition);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($addition)
							->once
		;
	}
}
