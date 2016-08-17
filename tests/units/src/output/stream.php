<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class stream extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('estvoyage\risingsun\ostring')
		;
	}

	function testOutputStreamIs()
	{
		$this
			->given(
				$stream = new mockOfOutput\stream,
				$this->calling($stream)->__toString = uniqid()
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->outputStreamIs($stream))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance((string) $stream))

			->given(
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->outputStreamIs($stream))
					->isNotTestedInstance
					->isEqualTo($this->newTestedInstance($value . $stream))
		;
	}
}
