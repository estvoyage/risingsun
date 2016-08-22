<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class iterator extends units\test
{
	function testLoopBodyIs()
	{
		$this
			->given(
				$payload = new mockOfIterator\payload
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->iteratorPayloadIs($payload))
					->isEqualTo($this->newTestedInstance)

			->given(
				$value = uniqid(),
				$this->calling($payload)->currentValueOfIteratorIs = function($iterator, $value) use (& $payloadValue) {
					$payloadValue = $value;
				}
			)
			->if(
				$this->newTestedInstance($value)
			)
			->then
				->object($this->testedInstance->iteratorPayloadIs($payload))
					->isEqualTo($this->newTestedInstance($value))
				->string($payloadValue)->isEqualTo($value)

			->given(
				$otherValue = uniqid(),
				$this->calling($payload)->currentValueOfIteratorIs = function($iterator, $value) use (& $payloadValue) {
					$payloadValue = $value;

					$iterator->nextIteratorValuesAreUseless();
				}
			)
			->if(
				$this->newTestedInstance($value, $otherValue)
			)
			->then
				->object($this->testedInstance->iteratorPayloadIs($payload))
					->isEqualTo($this->newTestedInstance($value, $otherValue))
				->string($payloadValue)->isNotEqualTo($otherValue)
		;
	}

	function testNextIteratorValueAreUseless()
	{
		$this->object($this->newTestedInstance->nextIteratorValuesAreUseless())->isEqualTo($this->newTestedInstance);
	}
}
