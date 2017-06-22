<?php namespace estvoyage\risingsun\tests\units\oboolean\recipient;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, oboolean as mockOfOBoolean };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\oboolean\recipient')
		;
	}

	function testObooleanIs()
	{
		$this
			->given(
				$this->newTestedInstance($block = new mockOfBlock),
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->testedInstance->obooleanIs($oboolean)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->withArguments($oboolean)
							->once
		;
	}
}
