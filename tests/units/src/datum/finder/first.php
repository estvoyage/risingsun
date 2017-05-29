<?php namespace estvoyage\risingsun\tests\units\datum\finder;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, ointeger, datum };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class first extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\finder')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ointeger\unsigned\any));
	}

	function testRecipientOfSearchOfDatumInDatumIs()
	{
		$this
			->given(
				$search = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\finder\recipient,
				$start = new ointeger\unsigned\any
			)
			->if(
				$this->newTestedInstance($start)
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($start))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->never

			->given(
				$searchValue = 'c',
				$datumValue = 'abcdeabcde'
			)
			->if(
				$this->calling($search)->recipientOfNStringIs = function($recipient) use (& $searchValue) {
					$recipient->nstringIs($searchValue);
				},
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($start))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->withArguments(new ointeger\unsigned\any(2))
							->once

			->if(
				$searchValue = 'z'
			)
			->then
				->object($this->testedInstance->recipientOfSearchOfDatumInDatumIs($search, $datum, $recipient))
					->isEqualTo($this->newTestedInstance($start))
				->mock($recipient)
					->receive('datumIsAtPosition')
						->once
		;
	}
}
