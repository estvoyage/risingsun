<?php namespace estvoyage\risingsun\tests\units\ointeger\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class pow extends units\test
{
	use units\providers\ointeger\operation\pow;

	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\operation\unary')
		;
	}

	function testRecipientOfOperationWithOIntegerIs_withNoMessage()
	{
		$this
			->given(
				$this->newTestedInstance($pow = new mockOfOInteger, $template = new mockOfOInteger, $overflow = new mockOfBlock),
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($pow, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider nintegersProvider
	 */
	function testRecipientOfOperationWithOIntegerIs_withValidOperand($ointegerValue, $powValue, $operationValue)
	{
		$this
			->given(
				$this->newTestedInstance($pow = new mockOfOInteger, $template = new mockOfOInteger, $overflow = new mockOfBlock),
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,

				$this->calling($pow)->recipientOfNIntegerIs = function($recipient) use ($powValue) {
					$recipient->nintegerIs($powValue);
				},

				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use ($ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				},

				$operation = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) use ($operation, $operationValue) {
					(new comparison\unary\equal($operationValue))
						->recipientOfComparisonWithOperandIs(
							$value,
							new comparison\recipient\ok(
								new block\functor(
									function() use ($recipient, $operation)
									{
										$recipient->ointegerIs($operation);
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
					->isEqualTo($this->newTestedInstance($pow, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($operation)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never
		;
	}

	/**
	 * @dataProvider overflowProvider
	 */
	function testRecipientOfOperationWithOIntegerIs_withOverflow($powValue, $ointegerValue)
	{
		$this
			->given(
				$this->newTestedInstance($pow = new mockOfOInteger, $template = new mockOfOInteger, $overflow = new mockOfBlock),
				$ointeger = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,

				$this->calling($pow)->recipientOfNIntegerIs = function($recipient) use ($powValue) {
					$recipient->nintegerIs($powValue);
				},

				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use ($ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				},

				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($value, $recipient) {
					$recipient->ointegerIs(new mockOfOInteger);
				}
			)
			->if(
				$this->testedInstance->recipientOfOperationWithOIntegerIs($ointeger, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($pow, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
