<?php namespace estvoyage\risingsun\tests\units\ointeger\ninteger;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, block as mockOfBlock };

class aggregator extends units\test
{
	function testBlockIs()
	{
		$this
			->given(
				$ointeger1 = new mockOfOInteger,
				$ointeger2 = new mockOfOInteger,
				$block = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($ointeger1, $ointeger2)
			)
			->then
				->object($this->testedInstance->blockIs($block))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($ointeger1)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(1);
				}
			)
			->then
				->object($this->testedInstance->blockIs($block))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($ointeger2)->recipientOfNIntegerIs = function($recipient) {
					$recipient->nintegerIs(2);
				}
			)
			->then
				->object($this->testedInstance->blockIs($block))
					->isEqualTo($this->newTestedInstance($ointeger1, $ointeger2))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments(1, 2)
							->once
		;
	}
}
