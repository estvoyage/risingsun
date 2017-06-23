<?php namespace estvoyage\risingsun\tests\units\nstring\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\datum as mockOfDatum;

class datum extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\nstring\recipient')
		;
	}

	function testNStringIs()
	{
		$this
			->given(
				$this->newTestedInstance($datum = new mockOfDatum, $recipient = new mockOfDatum\recipient),
				$nstring = uniqid()
			)
			->if(
				$this->testedInstance->nstringIs($nstring)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($datum, $recipient))
				->mock($datum)
					->receive('recipientOfDatumWithNStringIs')
						->withArguments($nstring, $recipient)
							->once
		;
	}
}
