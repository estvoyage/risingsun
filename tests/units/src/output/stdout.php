<?php namespace estvoyage\risingsun\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\output
;

class stdout extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\output')
		;
	}

	function testEndOfLine()
	{
		$this->output(function() {
					$this->object($this->newTestedInstance->endOfLine())->isTestedInstance;
				}
			)->isEqualTo(PHP_EOL)
		;
	}

	function testOutputStreamIs()
	{
		$this
			->given(
				$stream = new output\stream(uniqid())
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->output(function() use ($stream) {
						$this->object($this->testedInstance->outputStreamIs($stream))->isTestedInstance;
					}
				)->isEqualTo($stream)
		;
	}
}
