<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, ostring };
use mock\estvoyage\risingsun\datum as mockOfDatum;

class stdout extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new ostring\any(PHP_EOL)));
	}

	function testDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($datum) {
						$this->object($this->testedInstance->datumIs($datum))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEmpty

			->given(
				$datumValue = uniqid()
			)
			->if(
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				}
			)
			->then
				->output(function() use ($datum) {
						$this->object($this->testedInstance->datumIs($datum))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo($datumValue)
		;
	}

	function testEndOfLine()
	{
		$this
			->given(
				$eol = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($eol)
			)
			->then
				->output(function() use ($eol) {
						$this->object($this->testedInstance->endOfLine())
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEmpty

			->given(
				$eolValue = uniqid()
			)
			->if(
				$this->calling($eol)->recipientOfNStringIs = function($recipient) use ($eolValue) {
					$recipient->nstringIs($eolValue);
				}
			)
			->then
				->output(function() use ($eol) {
						$this->object($this->testedInstance->endOfLine())
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEqualTo($eolValue)
		;
	}

	function testOutputLineIs()
	{
		$this
			->given(
				$line = new mockOfDatum,
				$eol = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($eol)
			)
			->then
				->output(function() use ($line, $eol) {
						$this->object($this->testedInstance->outputLineIs($line))
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEmpty

			->given(
				$lineValue = uniqid(),
				$eolValue = uniqid()
			)
			->if(
				$this->calling($line)->recipientOfNStringIs = function($recipient) use ($lineValue) {
					$recipient->nstringIs($lineValue);
				},
				$this->calling($eol)->recipientOfNStringIs = function($recipient) use ($eolValue) {
					$recipient->nstringIs($eolValue);
				}
			)
			->then
				->output(function() use ($line, $eol) {
						$this->object($this->testedInstance->outputLineIs($line))
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEqualTo($lineValue . $eolValue)
		;
	}

	function testOutputLineIsOperationOnData()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\binary,
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum,
				$eol = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($eol)
			)
			->then
				->output(function() use ($operation, $firstDatum, $secondDatum, $eol) {
						$this->object($this->testedInstance->outputLineIsOperationOnData($operation, $firstDatum, $secondDatum))
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEmpty

			->given(
				$eolValue = uniqid(),
				$datumValue = uniqid(),
				$datum = new mockOfDatum
			)
			->if(
				$this->calling($eol)->recipientOfNStringIs = function($recipient) use ($eolValue) {
					$recipient->nstringIs($eolValue);
				},

				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				},

				$this->calling($operation)->recipientOfDatumOperationOnDataIs = function($aFirstDatum, $aSecondDatum, $recipient) use ($firstDatum, $secondDatum, $datum) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($aSecondDatum, $secondDatum, $recipient, $datum)
								{
									(
										new comparison\binary\equal(
											new block\functor(
												function() use ($recipient, $datum)
												{
													$recipient->datumIs($datum);
												}
											)
										)
									)
										->referenceForComparisonWithOperandIs($aSecondDatum, $secondDatum)
									;
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($aFirstDatum, $firstDatum)
					;
				}
			)
			->then
				->output(function() use ($operation, $firstDatum, $secondDatum, $eol) {
						$this->object($this->testedInstance->outputLineIsOperationOnData($operation, $firstDatum, $secondDatum))
							->isEqualTo($this->newTestedInstance($eol))
						;
					}
				)
					->isEqualTo($datumValue . $eolValue)
		;
	}
}
