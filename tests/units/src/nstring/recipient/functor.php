<?php namespace estvoyage\risingsun\tests\units\nstring\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\nstring\recipient')
		;
	}

	function testNstringIs()
	{
		$this
			->given(
				$nstring = uniqid(),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nstringIs($nstring))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $nstring ])
		;
	}

}
