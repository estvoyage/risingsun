<?php namespace estvoyage\risingsun\tests\units\time\clock\timestamp\unix;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, time\duration\timestamp };
use mock\estvoyage\risingsun\{ time\duration\timestamp\unix as mockOfUnix, ofloat as mockOfOFloat };

class micro extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\time\clock')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new timestamp\unix\micro\any));
	}

	function testRecipientOfMicroUnixTimestampIs()
	{
		$this
			->given(
				$template = new mockOfUnix\micro,
				$recipient = new mockOfUnix\micro\recipient,
				$now = microtime(true)
			)
			->if(
				$this->function->microtime = function($float) use ($now) {
					return $float ? $now : 0.145677877 . ' ' .  rand(0, PHP_INT_MAX);
				},
				$this->newTestedInstance($template)
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->never

			->given(
				$timestamp = new mockOfUnix\micro
			)
			->if(
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($now, $timestamp) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($recipient, $timestamp)
								{
									$recipient->ointegerIs($timestamp);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs(
							$ninteger,
							$now * 1000000
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfMicroUnixTimestampIs($recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('microUnixTimestampIs')
						->withArguments($timestamp)
							->once
		;
	}
}
