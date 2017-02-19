<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ output as mockOfOutput, ostring as mockOfOString };

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
				$line = new mockOfOString
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
					->isEmpty

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
}
