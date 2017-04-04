<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;

class error extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$error = new \mock\error
			)
			->if(
				$this->newTestedInstance($error)
			)
			->then
				->exception(
					function() {
						$this->testedInstance->blockArgumentsAre();
					}
				)
					->isIdenticalTo($error)
		;
	}
}
