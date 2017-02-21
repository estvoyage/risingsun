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
				$recipient = new mockOfNString\recipient,
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
					->receive('nstringIs')
						->never

			->if(
				$this->calling($datum)->recipientOfNStringIs = function($aRecipient) {
					$aRecipient->nstringIs('foo');
				}
			)
			->then
				->object($this->testedInstance->recipientOfOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($operation1, $operation2))
				->mock($recipient)
					->receive('nstringIs')
						->withArguments('foo')
							->once

			->if(
				$this->calling($operation1)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) use ($datum) {
					oboolean\factory::areIdenticals($aDatum, $datum)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->nstringIs('foo');
								}
							)
						)
					;
				},
				$this->calling($operation2)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) {
					oboolean\factory::areEquals($aDatum, new ostring\any('foo'))
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->nstringIs('foobar');
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
					->receive('nstringIs')
						->withArguments('foobar')
							->once
		;
	}

	function testRecipientOfOperationIs()
	{
		$this
			->given(
				$recipient = new mockOfNString\recipient,
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
					->receive('nstringIs')
						->withArguments('')
							->once

			->if(
				$this->calling($operation1)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) {
					oboolean\factory::areEquals($aDatum, new ostring\any)
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->nstringIs('foo');
								}
							)
						)
					;
				},
				$this->calling($operation2)->recipientOfOperationWithDatumIs = function($aDatum, $aRecipient) {
					oboolean\factory::areEquals($aDatum, new ostring\any('foo'))
						->blockForTrueIs(
							new functor(
								function() use ($aRecipient)
								{
									$aRecipient->nstringIs('foobar');
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
					->receive('nstringIs')
						->withArguments('foobar')
							->once
		;
	}
}
