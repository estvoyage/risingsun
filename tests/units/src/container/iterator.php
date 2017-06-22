<?php namespace estvoyage\risingsun\tests\units\container;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, container, oboolean, ointeger\generator };
use mock\estvoyage\risingsun\{ container as mockOfContainer, ointeger as mockOfOInteger, datum as mockOfDatum, comparison as mockOfComparison };

class iterator extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\container\iterator')
			->implements('estvoyage\risingsun\comparison\binary\container\iterator')
			->implements('estvoyage\risingsun\container\iterator\engine')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance)->isEqualTo($this->newTestedInstance(new container\iterator\engine\fifo));
	}

	function testPayloadForDataIs()
	{
		$this
			->given(
				$engine = new mockOfContainer\iterator\engine,
				$payload = new mockOfDatum\container\payload,
				$datum = new mockOfDatum
			)
			->if(
				$this->newTestedInstance($engine)
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum))
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForDatumAtPositionIs')
						->never

			->given(
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller
			)
			->if(
				$this->calling($engine)->valuesForContainerIteratorPayloadIs = function($payload, ... $values) use ($datum, $position, $controller) {
					if ($values[0] == $datum)
					{
						$payload->containerIteratorEngineControllerOfValueAtPositionIs($values[0], $position, $controller);
					}
				}
			)
			->then
				->object($this->testedInstance->dataForPayloadAre($payload, $datum))
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForDatumAtPositionIs')
						->withArguments($datum, $position, $controller)
							->once
		;
	}

	function testBinaryComparisonsForPayloadAre()
	{
		$this
			->given(
				$engine = new mockOfContainer\iterator\engine,
				$payload = new mockOfComparison\binary\container\payload,
				$comparison = new mockOfComparison\binary
			)
			->if(
				$this->newTestedInstance($engine)
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadAre($payload, $comparison))
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForBinaryComparisonAtPositionIs')
						->never

			->given(
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller
			)
			->if(
				$this->calling($engine)->valuesForContainerIteratorPayloadIs = function($payload, ... $values) use ($comparison, $position, $controller) {
					$payload->containerIteratorEngineControllerOfValueAtPositionIs($values[0], $position, $controller);
				}
			)
			->then
				->object($this->testedInstance->binaryComparisonsForPayloadAre($payload, $comparison))
					->isEqualTo($this->newTestedInstance($engine))
				->mock($payload)
					->receive('containerIteratorEngineControllerForBinaryComparisonAtPositionIs')
						->withArguments($comparison, $position, $controller)
							->once
		;
	}

	function testValuesForContainerIteratorPayloadIs()
	{
		$this
			->given(
				$engine = new mockOfContainer\iterator\engine,
				$payload = new mockOfContainer\iterator\payload,
				$value1 = uniqid(),
				$value2 = true
			)
			->if(
				$this->newTestedInstance($engine)
			)
			->then
				->object($this->testedInstance->valuesForContainerIteratorPayloadIs($payload, $value1, $value2))
					->isEqualTo($this->newTestedInstance($engine))
				->mock($engine)
					->receive('valuesForContainerIteratorPayloadIs')
						->withArguments($payload, $value1, $value2)
							->once
		;
	}
}
