<?php namespace estvoyage\risingsun\tests\units\ostring\recipient\block;

require __DIR__ . '/../../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\ostring
;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ostring\recipient')
		;
	}

	function testOstringIs()
	{
		$this
			->given(
				$callable = function($aString) use (& $stringReceived) { $stringReceived = $aString; },
				$string = new ostring(uniqid())
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->ostringIs($string))
					->isEqualTo($this->newTestedInstance($callable))
				->object($stringReceived)
					->isEqualTo($string)
		;
	}
}
