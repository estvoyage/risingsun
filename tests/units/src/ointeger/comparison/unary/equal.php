<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, block, ointeger };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class equal extends units\test
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
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new ointeger\any, new block\blackhole))
		;
	}

	function testRecipientOfOIntegerComparisonWithOIntegerIs()
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
				$referenceValue = 1
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
				$ointegerValue = -1
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
				$ointegerValue = 2
			)
			->then
				->object($this->testedInstance->oIntegerForComparisonIs($ointeger))
					->isEqualTo($this->newTestedInstance($ok, $reference, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->twice

			->if(
				$ointegerValue = 1
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
