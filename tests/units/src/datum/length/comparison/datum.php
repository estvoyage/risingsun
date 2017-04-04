<?php namespace estvoyage\risingsun\tests\units\datum\length\comparison;

require __DIR__ . '/../../../../runner.php';

use estvoyage\{ risingsun\tests\units, risingsun\datum\length, risingsun, risingsun\block };
use mock\estvoyage\risingsun\{ block as mockOfBlock, datum as mockOfDatum };

class datum extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\length\comparison')
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
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($ok, new risingsun\ostring\any, new block\blackhole))
		;
	}

	function testDatumLengthForComparisonIs()
	{
		$this
			->given(
				$ok = new mockOfBlock,
				$ko = new mockOfBlock,
				$datum = new mockOfDatum,
				$this->newTestedInstance($ok, $datum, $ko)
			)
			->if(
				$length = new length(0)
			)
			->then
				->object($this->testedInstance->datumLengthForComparisonIs($length))
					->isEqualTo($this->newTestedInstance($ok, $datum, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->never
				->mock($ko)
					->receive('blockArgumentsAre')
						->never

			->given(
				$this->calling($datum)->recipientOfDatumLengthIs = function($recipient) use (& $datumLength) {
					$recipient->datumLengthIs($datumLength);
				}
			)
			->if(
				$datumLength = $length
			)
			->then
				->object($this->testedInstance->datumLengthForComparisonIs($length))
					->isEqualTo($this->newTestedInstance($ok, $datum, $ko))
				->mock($ok)
					->receive('blockArgumentsAre')
						->once
				->mock($ko)
					->receive('blockArgumentsAre')
						->never
		;
	}
}
