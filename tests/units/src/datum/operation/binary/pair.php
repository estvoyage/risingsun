<?php namespace estvoyage\risingsun\tests\units\datum\operation\binary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class pair extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\binary')
		;
	}

	function testRecipientOfOperationOnDataIs()
	{
		$this
			->given(
				$prefix = new mockOfDatum,
				$separator = new mockOfDatum,
				$suffix = new mockOfDatum,
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$recipient = new mockOfNString\recipient
			)
			->if(
				$this->newTestedInstance($prefix, $separator, $suffix)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance($prefix, $separator, $suffix))
				->mock($recipient)
					->receive('nstringIs')
						->never

			->given(
				$prefixValue = uniqid(),
				$separatorValue = uniqid(),
				$suffixValue = uniqid(),
				$firstDatumValue = uniqid(),
				$secondDatumValue = uniqid(),
				$operation = new mockOfDatum
			)
			->if(
				$this->calling($prefix)->recipientOfNStringIs = function($recipient) use ($prefixValue) {
					$recipient->nstringIs($prefixValue);
				},
				$this->calling($separator)->recipientOfNStringIs = function($recipient) use ($separatorValue) {
					$recipient->nstringIs($separatorValue);
				},
				$this->calling($suffix)->recipientOfNStringIs = function($recipient) use ($suffixValue) {
					$recipient->nstringIs($suffixValue);
				},
				$this->calling($firstDatum)->recipientOfNStringIs = function($recipient) use ($firstDatumValue) {
					$recipient->nstringIs($firstDatumValue);
				},
				$this->calling($secondDatum)->recipientOfNStringIs = function($recipient) use ($secondDatumValue) {
					$recipient->nstringIs($secondDatumValue);
				},

				$this->newTestedInstance($prefix, $separator, $suffix)
			)
			->then
				->object($this->testedInstance->recipientOfOperationOnDataIs($firstDatum, $secondDatum, $recipient))
					->isEqualTo($this->newTestedInstance($prefix, $separator, $suffix))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments($prefixValue . $firstDatumValue . $separatorValue . $secondDatumValue . $suffixValue)
							->once
		;
	}
}
