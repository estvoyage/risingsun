<?php namespace estvoyage\risingsun\tests\units\datum\finder\recipient;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, ointeger as mockOfOInteger };

class proxy extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\finder\recipient')
		;
	}

	function testDatumIsAtPosition()
	{
		$this
			->given(
				$recipient = new mockOfOInteger\recipient,
				$datumNotExists = new mockOfBlock,
				$position = new mockOfOInteger\unsigned
			)
			->if(
				$this->newTestedInstance($recipient, $datumNotExists)
			)
			->then
				->object($this->testedInstance->datumIsAtPosition($position))
					->isEqualTo($this->newTestedInstance($recipient, $datumNotExists))
				->mock($recipient)
					->receive('ointegerIs')
						->withIdenticalArguments($position)
							->once
		;
	}

	function testDatumDoesNotExist()
	{
		$this
			->given(
				$recipient = new mockOfOInteger\recipient,
				$datumNotExists = new mockOfBlock
			)
			->if(
				$this->newTestedInstance($recipient, $datumNotExists)
			)
			->then
				->object($this->testedInstance->datumDoesNotExist())
					->isEqualTo($this->newTestedInstance($recipient, $datumNotExists))
				->mock($datumNotExists)
					->receive('blockArgumentsAre')
						->withArguments()
							->once
		;
	}
}
