<?php namespace estvoyage\risingsun\tests\units\ninteger\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ninteger\recipient')
		;
	}

	function testNIntegerIs()
	{
		$this
			->given(
				$ninteger = rand(PHP_INT_MIN, PHP_INT_MAX),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nintegerIs($ninteger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ninteger ])
		;
	}

}
