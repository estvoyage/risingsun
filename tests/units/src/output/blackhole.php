<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\output as mockOfOutput
;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function testOutputStreamIs()
	{
		$this
			->given(
				$stream = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->outputStreamIs($stream))->isTestedInstance
		;
	}

	function testLineIsOutputStream()
	{
		$this
			->given(
				$stream = new mockOfOutput\stream
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->lineIsOutputStream($stream))->isTestedInstance
		;
	}

	function testEndOfLine()
	{
		$this->object($this->newTestedInstance->endOfLine())->isTestedInstance;
	}
}
