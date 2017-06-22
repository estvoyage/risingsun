<?php namespace estvoyage\risingsun\tests\units\ointeger\generator\operation\binary;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, block, comparison };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\generator')
		;
	}

	function test__construct()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance(new ointeger\any, new ointeger\any(1), new ointeger\any, new block\blackhole))
		;
	}

	function testRecipientOfOIntegerIs()
	{
		$this
			->given(
				$this->newTestedInstance($start = new mockOfOInteger, $increment = new mockOfOInteger, $template = new mockOfOInteger, $overflow = new mockOfBlock),
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfOIntegerIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($start, $increment, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never

			->given(
				$startValue = 1,
				$this->calling($start)->recipientOfNIntegerIs = function($recipient) use ($startValue) {
					$recipient->nintegerIs($startValue);
				},

				$incrementValue = 2,
				$this->calling($increment)->recipientOfNIntegerIs = function($recipient) use ($incrementValue) {
					$recipient->nintegerIs($incrementValue);
				},

				$nextInteger = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($nextInteger) {
					(new comparison\unary\equal(5))
						->recipientOfComparisonWithOperandIs(
							5,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $nextInteger)
								{
									$recipient->ointegerIs($nextInteger);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfOIntegerIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($nextInteger, $increment, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($start)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->never

			->given(
				$startValue = PHP_INT_MAX,
				$this->calling($start)->recipientOfNIntegerIs = function($recipient) use ($startValue) {
					$recipient->nintegerIs($startValue);
				},

				$incrementValue = 1,
				$this->calling($increment)->recipientOfNIntegerIs = function($recipient) use ($incrementValue) {
					$recipient->nintegerIs($incrementValue);
				},

				$this->newTestedInstance($start, $increment, $template, $overflow)
			)
			->if(
				$this->testedInstance->recipientOfOIntegerIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($start, $increment, $template, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($start)
							->once
				->mock($overflow)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
