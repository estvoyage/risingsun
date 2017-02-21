<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary;

require __DIR__ . '/../../../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean, block\functor, ostring };
use mock\estvoyage\risingsun\{ datum as mockOfDatum, nstring as mockOfNString };

class pipe extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\datum\operation\unary')
		;
	}

	function testRecipientOfOperationWithDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient,
				$operation1 = new mockOfDatum\operation\unary,
				$operation2 = new mockOfDatum\operation\unary
			)
			->if(
				$this->newTestedInstance($operation1, $operation2)
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datum)
							->once

			->given(
				$datumOfOperation1 = new mockOfDatum
			)
			->if(
				$this->calling($operation1)->recipientOfOperationWithDatumIs = function($aDatum, $recipient) use ($datum, $datumOfOperation1) {
					oboolean\factory::areIdenticals($aDatum, $datum)
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $datumOfOperation1)
								{
									$recipient->datumIs($datumOfOperation1);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation1)
							->once

			->given(
				$datumOfOperation2 = new mockOfDatum
			)
			->if(
				$this->calling($operation2)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) use ($datumOfOperation1, $datumOfOperation2) {
					oboolean\factory::areIdenticals($aDatum, $datumOfOperation1)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient, $datumOfOperation2)
								{
									$aRecipient->datumIs($datumOfOperation2);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation2)
							->once
		;
	}

	function testRecipientOfOperationIs()
	{
		$this
			->given(
				$recipient = new mockOfDatum\recipient,
				$operation1 = new mockOfDatum\operation\unary,
				$operation2 = new mockOfDatum\operation\unary
			)
			->if(
				$this->newTestedInstance($operation1, $operation2)
			)
			->then
				->object($this->testedInstance->recipientOfOperationIs($recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withArguments(new ostring\any)
							->once

			->given(
				$datumOfOperation1 = new mockOfDatum
			)
			->if(
				$this->calling($operation1)->recipientOfOperationWithDatumIs = function($aDatum, $recipient) use ($datumOfOperation1) {
					oboolean\factory::areEquals($aDatum, new ostring\any)
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $datumOfOperation1)
								{
									$recipient->datumIs($datumOfOperation1);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationIs($recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation1)
							->once

			->given(
				$datumOfOperation2 = new mockOfDatum
			)
			->if(
				$this->calling($operation2)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) use ($datumOfOperation1, $datumOfOperation2) {
					oboolean\factory::areIdenticals($aDatum, $datumOfOperation1)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient, $datumOfOperation2)
								{
									$aRecipient->datumIs($datumOfOperation2);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationIs($recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('datumIs')
						->withIdenticalArguments($datumOfOperation2)
							->once
		;
	}
}
