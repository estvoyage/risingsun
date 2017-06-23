<?php namespace estvoyage\risingsun\tests\units\datum\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\datum as mockOfDatum;

class operation extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\recipient')
		;
	}

	function testDatumIs()
	{
		$this
			->given(
				$this->newTestedInstance($operation = new mockOfDatum\operation\unary, $recipient = new mockOfDatum\recipient),
				$datum = new mockOfDatum
			)
			->if(
				$this->testedInstance->datumIs($datum)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($operation, $recipient))
				->mock($operation)
					->receive('recipientOfDatumOperationWithDatumIs')
						->withArguments($datum, $recipient)
							->once
		;
	}
}
