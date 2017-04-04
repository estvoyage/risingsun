<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new block\blackhole));
	}

	function testRecipientOfOperationOnOIntegersAre()
	{
		$this
			->given(
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,
				$overflow = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($overflow)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$addition = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($addition) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($addition, $recipient)
								{
									$recipient->ointegerIs($addition);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($ninteger, 3)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($addition)
							->once

			->if(
				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(PHP_INT_MAX);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($addition)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
