<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum\operation };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, datum as mockOfDatum };

class right extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationWithDatumIs()
	{
		$this
			->given(
				$length = new mockOfOInteger\unsigned,
				$padding = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($length, $padding)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($datum)
					->receive('recipientOfDatumOperationWithDatumIs')
						->withArguments(new operation\binary\padding\right($length), $padding, $recipient)
							->once
		;
	}
}
