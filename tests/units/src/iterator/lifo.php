<?php namespace estvoyage\risingsun\tests\units\iterator;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class lifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\iterator')
		;
	}

	function testIteratorPayloadForValuesIs()
	{
		$this
			->given(
				$array = [ 0, 1 ],
				$iteratorValues = [],
				$payload = new mockOfIterator\payload,
				$this->calling($payload)->currentValueOfIteratorIs = function($iterator, $value) use (& $iteratorValues) {
					$iteratorValues[] = $value;
				}
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->iteratorPayloadForValuesIs($array, $payload))
					->isEqualTo($this->newTestedInstance)
				->array($iteratorValues)->isEqualTo([ 1, 0 ])

			->given(
				$iteratorValues = [],
				$this->calling($payload)->currentValueOfIteratorIs = function($iterator, $value) use (& $iteratorValues) {
					$iteratorValues[] = $value;

					if ($value == 1)
					{
						$iterator->nextIteratorValuesAreUseless();
					}
				}
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->iteratorPayloadForValuesIs($array, $payload))
					->isEqualTo($this->newTestedInstance)
				->array($iteratorValues)->isEqualTo([ 1 ])
		;
	}

	function testNextIteratorValuesAreUseless()
	{
		$this->object($this->newTestedInstance->nextIteratorValuesAreUseless())->isEqualTo($this->newTestedInstance);
	}
}
