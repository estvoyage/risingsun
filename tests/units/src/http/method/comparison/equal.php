<?php namespace estvoyage\risingsun\tests\units\http\method\comparison;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean };
use mock\estvoyage\risingsun\{ http as mockOfHttp, oboolean as mockOfOBoolean };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\http\method\comparison')
		;
	}

	function testRecipientOfComparisonBetweenHttpMethodsIs()
	{
		$this
			->given(
				$firstOperand = new mockOfHttp\method,
				$secondOperand = new mockOfHttp\method,
				$recipient = new mockOfOBoolean\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenHttpMethodsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$this->calling($firstOperand)->recipientOfHttpMethodValueIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenHttpMethodsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->never

			->if(
				$this->calling($secondOperand)->recipientOfHttpMethodValueIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfComparisonBetweenHttpMethodsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ok)
							->once

			->if(
				$this->calling($secondOperand)->recipientOfHttpMethodValueIs = function($recipient) {
					$recipient->nstringIs('bar');
				}
			)
				->object($this->testedInstance->recipientOfComparisonBetweenHttpMethodsIs($firstOperand, $secondOperand, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('obooleanIs')
						->withArguments(new oboolean\ko)
							->once
		;
	}
}
