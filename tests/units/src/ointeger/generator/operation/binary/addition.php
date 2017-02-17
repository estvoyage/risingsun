<?php namespace estvoyage\risingsun\tests\units\ointeger\generator\operation\binary;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean\factory, block\functor, ointeger\operation, ointeger };
use mock\estvoyage\risingsun\ointeger as mockOfOInteger;

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
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$addition = new mockOfOInteger,
				$this->calling($start)->recipientOfOperationWithOIntegerIs = function($operation, $ointeger, $recipient) use ($increment, $addition) {
					factory::areEquals($operation, new operation\binary\addition)
						->blockForTrueIs(
							new functor(
								function() use ($ointeger, $recipient, $increment, $addition)
								{
									factory::areEquals($ointeger, $increment)
										->blockForTrueIs(
											new functor(
												function() use ($recipient, $addition)
												{
													$recipient->ointegerIs($addition);
												}
											)
										)
									;
								}
							)
						)
					;
				},

				$this->newTestedInstance($start, $increment)
			)
			->then
				->object($this->testedInstance->recipientOfOIntegerIs($recipient))
					->isEqualTo($this->newTestedInstance($addition, $increment))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($start)
							->once
		;
	}
}