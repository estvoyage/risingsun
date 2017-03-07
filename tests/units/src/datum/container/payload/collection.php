<?php namespace estvoyage\risingsun\tests\units\datum\container\payload;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger, container as mockOfContainer };

class collection extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\payload')
		;
	}

	function testContainerIteratorEngineControllerForDatumAtPositionIs()
	{
		$this
			->given(
				$payload1 = new mockOfDatum\container\payload,
				$payload2 = new mockOfDatum\container\payload,
				$datum = new mockOfDatum,
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller
			)
			->if(
				$this->newTestedInstance($payload1, $payload2)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForDatumAtPositionIs($datum, $position, $controller))
					->isEqualTo($this->newTestedInstance($payload1, $payload2))
				->mock($payload1)
					->receive('containerIteratorEngineControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum, $position, $controller)
							->once
				->mock($payload2)
					->receive('containerIteratorEngineControllerForDatumAtPositionIs')
						->withIdenticalArguments($datum, $position, $controller)
							->once
		;
	}
}
