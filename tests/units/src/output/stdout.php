<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\{ output as mockOfOutput, ostring as mockOfOString, datum as mockOfDatum };

class stdout extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function testNStringIs()
	{
		$this
			->given(
				$nstring = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($nstring) {
						$this->object($this->testedInstance->nstringIs($nstring))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo($nstring)
		;
	}

	function testEndOfLine()
	{
		$this
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() {
						$this->object($this->testedInstance->endOfLine())
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo(PHP_EOL)
		;
	}

	function testOutputLineIs()
	{
		$this
			->given(
				$line = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($line) {
						$this->object($this->testedInstance->outputLineIs($line))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo($line . PHP_EOL)
		;
	}

	function testOutputLineIsOperationOnData()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation,
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($operation, $firstDatum, $secondDatum) {
						$this->object($this->testedInstance->outputLineIsOperationOnData($operation, $firstDatum, $secondDatum))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEmpty

			->given(
				$operationValue = uniqid()
			)
			->if(
				$this->calling($operation)->recipientOfOperationOnDataIs = function($aFirstDatum, $aSecondDatum, $recipient) use ($firstDatum, $secondDatum, $operationValue) {
					oboolean\factory::areEquals($aFirstDatum, $firstDatum)
						->blockForTrueIs(
							new functor(
								function() use ($aSecondDatum, $secondDatum, $recipient, $operationValue)
								{
									oboolean\factory::areEquals($aSecondDatum, $secondDatum)
										->blockForTrueIs(
											new functor(
												function() use ($recipient, $operationValue)
												{
													$recipient->nstringIs($operationValue);
												}
											)
										)
									;
								}
							)
						)
					;
				}
			)
			->then
				->output(function() use ($operation, $firstDatum, $secondDatum) {
						$this->object($this->testedInstance->outputLineIsOperationOnData($operation, $firstDatum, $secondDatum))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo($operationValue . PHP_EOL)
		;
	}
}
