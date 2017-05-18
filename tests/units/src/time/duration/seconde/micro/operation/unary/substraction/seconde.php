<?php namespace estvoyage\risingsun\tests\units\time\duration\seconde\micro\operation\unary\substraction;

require __DIR__ . '/../../../../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ninteger, comparison, block };
use mock\estvoyage\risingsun\time as mockOfTime;

class seconde extends units\test
{
	function testMicroSecondRecipientForOperationWithMicroSecondeIs_withBlackhole()
	{
		$this
			->given(
				$seconde = new mockOfTime\duration\seconde,
				$recipient = new mockOfTime\duration\seconde\micro\recipient,
				$micro = new mockOfTime\duration\seconde\micro
			)
			->if(
				$this->newTestedInstance($seconde)
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->never
		;
	}

	/**
	 * @dataProvider substractionProvider
	 */
	function testMicroSecondRecipientForOperationWithMicroSecondeIs($microValue, $secondeValue, $substraction)
	{
		$this
			->given(
				$seconde = new mockOfTime\duration\seconde,
				$recipient = new mockOfTime\duration\seconde\micro\recipient,
				$micro = new mockOfTime\duration\seconde\micro,
				$this->newTestedInstance($seconde)
			)
			->if(
				$this->calling($micro)->recipientOfNIntegerIs = function($recipient) use ($microValue) {
					$recipient->nintegerIs($microValue);
				},

				$microFromOperation = new mockOfTime\duration\seconde\micro,

				$this->calling($micro)->recipientOfMicroSecondeWithNIntegerIs = function($ninteger, $recipient) use ($microFromOperation, $substraction) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							$substraction,
							new comparison\recipient\functor\ok(
								function() use ($microFromOperation, $recipient)
								{
									$recipient->microSecondeIs($microFromOperation);
								}
							)
						)
					;
				},

				$this->calling($seconde)->recipientOfNIntegerIs = function($recipient) use ($secondeValue) {
					$recipient->nintegerIs($secondeValue);
				}
			)
			->then
				->object($this->testedInstance->microSecondeRecipientForOperationWithMicroSecondeIs($micro, $recipient))
					->isEqualTo($this->newTestedInstance($seconde))
				->mock($recipient)
					->receive('microSecondeIs')
						->withArguments($microFromOperation)
							->once
		;
	}

	protected function substractionProvider()
	{
		return [
			[ 0, 0, 0 ],
			[ 1000000, 0, - 1000000 ],
			[ 1000000, 1, 0 ],
			[ 1600000, 2, 400000 ]
		];
	}
}
