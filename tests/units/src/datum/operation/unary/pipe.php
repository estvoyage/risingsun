<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, comparison, block, ostring };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, ointeger as mockOfOInteger, container as mockOfContainer };

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
				$this->newTestedInstance($template = new mockOfDatum, $iterator = new mockOfDatum\operation\unary\container\iterator, $container = new mockOfDatum\operation\unary\container),
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $iterator, $container))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$datumFromTemplate = new mockOfDatum,
				$this->calling($template)->recipientOfDatumFromDatumIs = function($aDatum, $recipient) use ($datum, $datumFromTemplate) {
					(new comparison\unary\equal($datum))
						->recipientOfComparisonWithOperandIs(
							$aDatum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datumFromTemplate)
								{
									$recipient->datumIs($datumFromTemplate);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $iterator, $container))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($datumFromTemplate)
							->once

			->given(
				$operation = new mockOfDatum\operation\unary,
				$this->calling($container)->payloadForUnaryDatumOperationContainerIteratorIs = function($anIterator, $payload) use ($iterator, $operation) {
					(new comparison\unary\equal($iterator))
						->recipientOfComparisonWithOperandIs(
							$anIterator,
							new comparison\recipient\functor\ok(
								function() use ($anIterator, $payload, $operation)
								{
									$anIterator->unaryDatumOperationsForPayloadAre($payload, $operation);
								}
							)
						)
					;
				},

				$this->calling($iterator)->unaryDatumOperationsForPayloadAre = function($payload, $operation) {
					$payload->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs($operation, new mockOfOInteger, new mockOfContainer\iterator\engine\controller);
				},

				$datumOfOperation = new mockOfDatum,
				$this->calling($operation)->recipientOfDatumOperationWithDatumIs = function($aDatum, $recipient) use ($datum, $datumOfOperation) {
					(new comparison\unary\equal($datum))
						->recipientOfComparisonWithOperandIs(
							$aDatum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datumOfOperation)
								{
									$recipient->datumIs($datumOfOperation);
								}
							)
						)
					;
				},

				$datumFromTemplate = new mockOfDatum,
				$this->calling($template)->recipientOfDatumFromDatumIs = function($aDatum, $recipient) use ($datumOfOperation, $datumFromTemplate) {
					(new comparison\unary\equal($datumOfOperation))
						->recipientOfComparisonWithOperandIs(
							$aDatum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datumFromTemplate)
								{
									$recipient->datumIs($datumFromTemplate);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $iterator, $container))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($datumFromTemplate)
							->once
		;
	}

	function testRecipientOfDatumOperationIs()
	{
		$this
			->given(
				$this->newTestedInstance($template = new mockOfDatum, $iterator = new mockOfDatum\operation\unary\container\iterator, $container = new mockOfDatum\operation\unary\container),
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $iterator, $container))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$position = new mockOfOInteger,
				$controller = new mockOfContainer\iterator\engine\controller,
				$this->calling($iterator)->unaryDatumOperationsForPayloadAre = function($payload, ... $operations) use ($position, $controller) {
					$payload->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs(current($operations), $position, $controller);
				},

				$operation = new mockOfDatum\operation\unary,
				$this->calling($container)->payloadForUnaryDatumOperationContainerIteratorIs = function($iterator, $payload) use ($operation) {
					$iterator->unaryDatumOperationsForPayloadAre($payload, $operation);
				},

				$datumOfOperation = new mockOfDatum,
				$this->calling($operation)->recipientOfDatumOperationWithDatumIs = function($aDatum, $recipient) use ($datumOfOperation) {
					(new comparison\unary\equal(new ostring\any))
						->recipientOfComparisonWithOperandIs(
							$aDatum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datumOfOperation)
								{
									$recipient->datumIs($datumOfOperation);
								}
							)
						)
					;
				},

				$datumFromTemplate = new mockOfDatum,
				$this->calling($template)->recipientOfDatumFromDatumIs = function($datum, $recipient) use ($datumOfOperation, $datumFromTemplate) {
					(new comparison\unary\equal($datumOfOperation))
						->recipientOfComparisonWithOperandIs(
							$datum,
							new comparison\recipient\functor\ok(
								function() use ($recipient, $datumFromTemplate)
								{
									$recipient->datumIs($datumFromTemplate);
								}
							)
						)
					;
				}
			)
			->if(
				$this->testedInstance->recipientOfDatumOperationIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($template, $iterator, $container))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($datumFromTemplate)
							->once
		;
	}
}
