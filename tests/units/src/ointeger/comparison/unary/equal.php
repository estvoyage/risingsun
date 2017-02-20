<?php namespace estvoyage\risingsun\tests\units\ointeger\comparison\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class equal extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ointeger\comparison\unary')
		;
	}

	function testBlockForComparisonWithOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,
				$block = new mockOfBlock,
				$equal = new mockOfOInteger
			)
			->if(
				$this->newTestedInstance($equal)
			)
			->then
				->object($this->testedInstance->blockForComparisonWithOIntegerIs($ointeger, $block))
					->isEqualTo($this->newTestedInstance($equal))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($equal)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(42);
				},
				$this->calling($ointeger)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(666);
				}
			)
			->then
				->object($this->testedInstance->blockForComparisonWithOIntegerIs($ointeger, $block))
					->isEqualTo($this->newTestedInstance($equal))
				->mock($block)
					->receive('blockArgumentsAre')
						->never
				->object($this->testedInstance->blockForComparisonWithOIntegerIs($equal, $block))
					->isEqualTo($this->newTestedInstance($equal))
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}
}