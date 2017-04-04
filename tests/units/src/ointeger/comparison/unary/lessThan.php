<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, ointeger, block };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class lessThan extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$ok = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ok)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new ointeger\any, new block\blackhole));
	}

	function testOIntegerForComparisonIs()
	{
		$this
			->given(
				$reference = new mockOfOInteger,
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$ointeger = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($ok, $reference, $ko)
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($reference)->recipientOfNIntegerIs = function($recipient) use (& $referenceValue) {
					$recipient->nintegerIs($referenceValue);
				}
			)
			->if(
				$referenceValue = 0
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) use (& $ointegerValue) {
					$recipient->nintegerIs($ointegerValue);
				}
			)
			->if(
				$ointegerValue = 0
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$ointegerValue = - rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->once

			->if(
				$ointegerValue = rand(1, PHP_INT_MAX)
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice
		;
	}
}
