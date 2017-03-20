<?php namespace estvoyage\risingsun\tests\units\ointeger\generator\operation\binary;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean\factory, block\functor, ointeger\operation, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\generator')
		;
	}

	function testWithNoIncrement()
	{
		$this
			->given(
				$start = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($start)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($start, new ointeger\any(1)))
		;
	}

	function testWithNoStart()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance(new ointeger\any, new ointeger\any(1)))
		;
	}

	function testRecipientOfOIntegerIs()
	{
		$this
			->given(
				$start = new mockOfOInteger,
				$increment = new mockOfOInteger,
				$recipient = new mockOfOInteger\recipient,
				$overflow  =new mockOfBlock
			)
			->if(
				$this->newTestedInstance($start, $increment, $overflow)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($start, $increment, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$startValue = 1,
				$incrementValue = 2,
				$nextInteger = new mockOfOInteger
			)
			->if(
				$this->calling($start)->recipientOfNIntegerIs = function($recipient) use ($startValue) {
					$recipient->nintegerIs($startValue);
				},
				$this->calling($increment)->recipientOfNIntegerIs = function($recipient) use ($incrementValue) {
					$recipient->nintegerIs($incrementValue);
				},
				$this->calling($start)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($nextInteger) {
					$recipient->ointegerIs($nextInteger);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($nextInteger, $increment, $overflow))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($start)
							->once

			->given(
				$startValue = PHP_INT_MAX,
				$incrementValue = 1,
				$this->newTestedInstance($start, $increment, $overflow)
			)
			->if(
				$this->calling($start)->recipientOfNIntegerIs = function($recipient) use ($startValue) {
					$recipient->nintegerIs($startValue);
				},
				$this->calling($increment)->recipientOfNIntegerIs = function($recipient) use ($incrementValue) {
					$recipient->nintegerIs($incrementValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($start, $increment, $overflow))
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
