<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor };
use mock\estvoyage\risingsun\{ output as mockOfOutput, ostring as mockOfOString, datum as mockOfDatum };

class stderr extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function testDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum
			)
			->if(
				$this->function->file_put_contents = function($filename, $data, $flags = 0) {
					oboolean\factory::areEquals($filename, 'php://stderr')
						->blockForTrueIs(
							new functor(
								function() use ($data, $flags)
								{
									oboolean\factory::areEquals($flags, FILE_APPEND|LOCK_EX)
										->blockForTrueIs(
											new functor(
												function() use ($data)
												{
													echo $data;
												}
											)
										)
									;
								}
							)
						)
					;
				},
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
				$this->function->file_put_contents = function($filename, $data, $flags = 0) {
					oboolean\factory::areEquals($filename, 'php://stderr')
						->blockForTrueIs(
							new functor(
								function() use ($data, $flags)
								{
									oboolean\factory::areEquals($flags, FILE_APPEND|LOCK_EX)
										->blockForTrueIs(
											new functor(
												function() use ($data)
												{
													echo $data;
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
				$line = new mockOfDatum
			)
			->if(
				$this->function->file_put_contents = function($filename, $data, $flags = 0) {
					oboolean\factory::areEquals($filename, 'php://stderr')
						->blockForTrueIs(
							new functor(
								function() use ($data, $flags)
								{
									oboolean\factory::areEquals($flags, FILE_APPEND|LOCK_EX)
										->blockForTrueIs(
											new functor(
												function() use ($data)
												{
													echo $data;
												}
											)
										)
									;
								}
							)
						)
					;
				},
				$this->newTestedInstance
			)
			->then
				->output(function() use ($line) {
						$this->object($this->testedInstance->outputLineIs($line))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo(PHP_EOL)

			->given(
				$lineValue = uniqid()
			)
			->if(
				$this->calling($line)->recipientOfNStringIs = function($recipient) use ($lineValue) {
					$recipient->nstringIs($lineValue);
				}
			)
			->then
				->output(function() use ($line) {
						$this->object($this->testedInstance->outputLineIs($line))
							->isEqualTo($this->newTestedInstance)
						;
					}
				)
					->isEqualTo($lineValue . PHP_EOL)
		;
	}

	function testOutputLineIsOperationOnData()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\binary,
				$firstDatum = new mockOfDatum,
				$secondDatum = new mockOfDatum
			)
			->if(
				$this->function->file_put_contents = function($filename, $data, $flags = 0) {
					oboolean\factory::areEquals($filename, 'php://stderr')
						->blockForTrueIs(
							new functor(
								function() use ($data, $flags)
								{
									oboolean\factory::areEquals($flags, FILE_APPEND|LOCK_EX)
										->blockForTrueIs(
											new functor(
												function() use ($data)
												{
													echo $data;
												}
											)
										)
									;
								}
							)
						)
					;
				},
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
				$datumValue = uniqid(),
				$datum = new mockOfDatum,
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use ($datumValue) {
					$recipient->nstringIs($datumValue);
				}
			)
			->if(
				$this->calling($operation)->recipientOfOperationOnDataIs = function($aFirstDatum, $aSecondDatum, $recipient) use ($firstDatum, $secondDatum, $datum) {
					oboolean\factory::areEquals($aFirstDatum, $firstDatum)
						->blockForTrueIs(
							new functor(
								function() use ($aSecondDatum, $secondDatum, $recipient, $datum)
								{
									oboolean\factory::areEquals($aSecondDatum, $secondDatum)
										->blockForTrueIs(
											new functor(
												function() use ($recipient, $datum)
												{
													$recipient->datumIs($datum);
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
					->isEqualTo($datumValue . PHP_EOL)
		;
	}
}
