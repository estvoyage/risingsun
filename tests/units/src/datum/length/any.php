<?php namespace estvoyage\risingsun\tests\units\datum\length;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, ointeger };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger };

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\length')
		;
	}

	function test__construct()
	{
		$this
			->given(
				$template = new ointeger\any
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($template))
		;
	}

	function testRecipientOfLengthOfDatumIs()
	{
		$this
			->given(
				$template = new mockOfOInteger,
				$this->newTestedInstance($template),
				$datum = new mockOfDatum,
				$recipient = new mockOfOInteger\recipient
			)
			->if(
				$this->testedInstance->recipientOfLengthOfDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('ointegerIs')
						->never

			->given(
				$nstring = uniqid(),
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($nstring) {
					$recipient->nstringIs($nstring);
				},

				$length = new mockOfOInteger,
				$this->calling($template)->recipientOfOIntegerWithNIntegerIs = function($ninteger, $recipient) use ($nstring, $length) {
					(new comparison\binary\equal)
						->recipientOfComparisonBetweenOperandAndReferenceIs(
							$ninteger,
							strlen($nstring),
							new comparison\recipient\functor\ok(
								function() use ($length, $recipient) {
									$recipient->ointegerIs($length);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfLengthOfDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template))
				->mock($recipient)
					->receive('ointegerIs')
						->withArguments($length)
							->once
		;
	}
}
