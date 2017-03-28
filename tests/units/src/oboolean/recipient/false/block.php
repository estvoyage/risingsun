<?php namespace estvoyage\risingsun\tests\units\oboolean\recipient\false;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ block as mockOfBlock, oboolean as mockOfOBoolean };

class block extends units\test
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
				$block = new mockOfBlock,
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->newTestedInstance($block)
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->never

			->if(
				$this->calling($oboolean)->blockForFalseIs = function($block) {
					$block->blockArgumentsAre();
				}
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($block))
				->mock($block)
					->receive('blockArgumentsAre')
						->once
		;
	}
}
