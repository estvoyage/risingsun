<?php namespace estvoyage\risingsun\tests\units\nfloat\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\nfloat\recipient')
		;
	}

	function testNFloatIs()
	{
		$this
			->given(
				$nfloat = (float) rand(- PHP_INT_MAX, PHP_INT_MAX),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nfloatIs($nfloat))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $nfloat ])
		;
	}
}
