<?php namespace estvoyage\risingsun\tests\units\comparison\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class error extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\comparison\recipient')
		;
	}

	function testNBooleanIs()
	{
		$this
			->given(
				$error = new \mock\error
			)
			->if(
				$this->newTestedInstance($error)
			)
			->then
				->object($this->testedInstance->nbooleanIs(false))
					->isEqualTo($this->testedInstance)
				->exception(
					function() {
						$this->testedInstance->nbooleanIs(true);
					}
				)
					->isIdenticalTo($error)
		;
	}
}
