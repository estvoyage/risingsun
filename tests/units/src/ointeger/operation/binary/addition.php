<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

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
				$recipient = new mockOfOInteger\recipient,
				$overflow = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($overflow)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
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
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
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
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance($overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->if(
				$addition = new mockOfOInteger,
				$this->calling($firstOperand)->recipientOfOIntegerWithValueIs = function($ninteger, $recipient) use ($addition) {
					oboolean\factory::areEquals($ninteger, 3)
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
				->object($this->testedInstance->recipientOfOperationOnIntegersIs($firstOperand, $secondOperand, $recipient))
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
