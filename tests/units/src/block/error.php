<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\oboolean as mockOfOBoolean;

class error extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
			->implements('estvoyage\risingsun\oboolean\recipient')
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

	function testOBooleanIs()
	{
		$this
			->given(
				$error = new \mock\error,
				$oboolean = new mockOfOBoolean
			)
			->if(
				$this->newTestedInstance($error)
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($error))

			->if(
				$this->calling($oboolean)->blockForTrueIs = function($block) {
					$block->blockArgumentsAre();
				}
			)
			->then
				->exception(
					function() use ($oboolean) {
						$this->testedInstance->obooleanIs($oboolean);
					}
				)
					->isIdenticalTo($error)
		;
	}
}
