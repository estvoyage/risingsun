<?php namespace estvoyage\risingsun\tests\units\ostring\recipient;

require __DIR__ . '/../../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\ostring,
	mock\estvoyage\risingsun\block as mockOfBlock
;

class block extends units\test
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
				$block = new mockOfBlock,
				$string = new ostring(uniqid())
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->ostringIs($string))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withIdenticalArguments($string)
							->once
		;
	}
}
