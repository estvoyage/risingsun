<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\container;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\datum\{ operation\unary\container as mockOfContainer, operation\unary as mockOfOperation };

class collection extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary\container')
		;
	}

	function testPayloadForUnaryDatumOperationContainerIteratorIs()
	{
		$this
			->given(
				$iterator = new mockOfContainer\iterator,
				$payload = new mockOfContainer\payload
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->payloadForUnaryDatumOperationContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance)
				->mock($iterator)
					->receive('unaryDatumOperationsForPayloadAre')
						->withArguments($payload)
							->once

			->given(
				$operation = new mockOfOperation
			)
			->if(
				$this->newTestedInstance($operation)
			)
			->then
				->object($this->testedInstance->payloadForUnaryDatumOperationContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($operation))
				->mock($iterator)
					->receive('unaryDatumOperationsForPayloadAre')
						->withArguments($payload, $operation)
							->once

			->given(
				$operation1 = new mockOfOperation,
				$operation2 = new mockOfOperation
			)
			->if(
				$this->newTestedInstance($operation1, $operation2)
			)
			->then
				->object($this->testedInstance->payloadForUnaryDatumOperationContainerIteratorIs($iterator, $payload))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($iterator)
					->receive('unaryDatumOperationsForPayloadAre')
						->withArguments($payload, $operation1, $operation2)
							->once
		;
	}
}
