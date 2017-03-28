<?php namespace estvoyage\risingsun\tests\units\datum\converter;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block\functor, ostring };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\converter')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ostring\any));
	}

	function testRecipientOfDatumIs()
	{
		$this
			->given(
				$template = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($template)
			)
			->then
				->object($this->testedInstance->recipientOfDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$datumValue = uniqid()
			)
			->if(
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$convertedDatum = new mockOfDatum
			)
			->if(
				$this->calling($template)->recipientOfDatumWithNStringIs = function($nstring, $recipient) use ($datumValue, $convertedDatum) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenValuesIs(
							$nstring,
							$datumValue,
							new functor(
								function() use ($recipient, $convertedDatum)
								{
									$recipient->datumIs($convertedDatum);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($convertedDatum)
							->once
		;
	}
}
