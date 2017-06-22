<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class pow extends units\test
{
	use units\providers\ointeger\operation\pow;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\binary')
		;
	}

	function testRecipientOfOperationsOnOIntegersIs_withNoMessage()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider validOperandsProvider
	 */
	function testRecipientOfOperationsOnOIntegersIs_withValidOperands($firstOperandValue, $secondOperandValue, $pow)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,

				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$powAsOInteger = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($pow, $powAsOInteger) {
					(new comparison\unary\equal($pow))
						->recipientOfComparisonWithOperandIs(
							$value,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $powAsOInteger)
								{
									$recipient->ointegerIs($powAsOInteger);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($powAsOInteger)
							->once
				->mock($overflow)
					->call('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider overflowProvider
	 */
	function testRecipientOfOperationsOnOIntegersIs_withOverflow($firstOperandValue, $secondOperandValue)
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfOInteger, $overflow = new mockOfBlock),
				$firstOperand = new mockOfOInteger,
				$secondOperand = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,

				$this->calling($firstOperand)->recipientOfNIntegerIs = function($recipient) use ($firstOperandValue) {
					$recipient->nintegerIs($firstOperandValue);
				},

				$this->calling($secondOperand)->recipientOfNIntegerIs = function($recipient) use ($secondOperandValue) {
					$recipient->nintegerIs($secondOperandValue);
				},

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) {
					$recipient->ointegerIs(new mockOfOInteger);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationOnOIntegersIs($firstOperand, $secondOperand, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->call('blockArgumentsAre')
						->once
		;
	}
}
