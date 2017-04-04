<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, ostring };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class pipe extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfDatumOperationWithDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient,
				$container = new mockOfDatum\operation\unary\container
			)
			->if(
				$this->newTestedInstance($container)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($container))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datum)
							->once

			->given(
				$operation = new mockOfDatum\operation\unary,
				$datumOfOperation = new mockOfDatum
			)
			->if(
				$this->calling($container)->payloadForUnaryDatumOperationContainerIteratorIs = function($iterator, $payload) use ($operation) {
					$iterator->unaryDatumOperationsForPayloadAre($payload, $operation);
				},

				$this->calling($operation)->recipientOfDatumOperationWithDatumIs = function($aDatum, $recipient) use ($datum, $datumOfOperation) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($recipient, $datumOfOperation)
								{
									$recipient->datumIs($datumOfOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($aDatum, $datum)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($container))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation)
							->once
		;
	}

	function testRecipientOfDatumOperationIs()
	{
		$this
			->given(
				$recipient = new mockOfDatum\recipient,
				$container = new mockOfDatum\operation\unary\container
			)
			->if(
				$this->newTestedInstance($container)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationIs($recipient))
					->isEqualTo($this->newTestedInstance($container))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any)
							->once

			->given(
				$operation = new mockOfDatum\operation\unary,
				$datumOfOperation = new mockOfDatum
			)
			->if(
				$this->calling($container)->payloadForUnaryDatumOperationContainerIteratorIs = function($iterator, $payload) use ($operation) {
					$iterator->unaryDatumOperationsForPayloadAre($payload, $operation);
				},

				$this->calling($operation)->recipientOfDatumOperationWithDatumIs = function($aDatum, $recipient) use ($datumOfOperation) {
					(
						new comparison\binary\equal(
							new block\functor(
								function() use ($recipient, $datumOfOperation)
								{
									$recipient->datumIs($datumOfOperation);
								}
							)
						)
					)
						->referenceForComparisonWithOperandIs($aDatum, new ostring\any)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationIs($recipient))
					->isEqualTo($this->newTestedInstance($container))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation)
							->once
		;
	}
}
