<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class addition extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfOperationWithDatumIs()
	{
		$this
			->given(
				$suffix = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($suffix)
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('nstringIs')
						->never

			->if(
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('bar');
				},
				$this->calling($datum)->recipientOfNStringIs = function($recipient) {
					$recipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($suffix))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('foobar')
							->once
		;
	}
}
