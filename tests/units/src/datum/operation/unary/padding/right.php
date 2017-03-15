<?php namespace estvoyage\risingsun\tests\units\datum\operation\unary\padding;

require __DIR__ . '/../../../../../runner.php';

use estvoyage\risingsun\{ tests\units, datum\operation, oboolean, block\functor };
use mock\estvoyage\risingsun\{ ointeger as mockOfOInteger, datum as mockOfDatum };

class right extends units\test
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
				$length = new mockOfOInteger\unsigned,
				$padding = new mockOfDatum,
				$datum = new mockOfDatum,
				$recipient = new mockOfDatum\recipient
			)
			->if(
				$this->newTestedInstance($length, $padding)
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$datumValue = '',
				$paddingValue = '',
				$lengthValue = 1
			)
			->if(
				$this->calling($datum)->recipientOfNStringIs = function($recipient) use (& $datumValue) {
					$recipient->nstringIs($datumValue);
				},
				$this->calling($padding)->recipientOfNStringIs = function($recipient) use (& $paddingValue) {
					$recipient->nstringIs($paddingValue);
				},
				$this->calling($length)->recipientOfNIntegerIs = function($recipient) use (& $lengthValue) {
					$recipient->nintegerIs($lengthValue);
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->never

			->given(
				$padded = new mockOfDatum
			)
			->if(
				$paddingValue = 'a',

				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded, $paddingValue) {
					oboolean\factory::areEquals($value, 'a')
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->once

			->if(
				$paddingValue = 'aaaa',
				$lengthValue = 8,

				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded) {
					oboolean\factory::areEquals($value, 'aaaaaaaa')
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->twice

			->if(
				$paddingValue = 'aaaaaaaa'
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->thrice

			->if(
				$paddingValue = '0',

				$this->calling($datum)->recipientOfDatumWithNStringIs = function($value, $recipient) use ($padded) {
					oboolean\factory::areEquals($value, '00000000')
						->blockForTrueIs(
							new functor(
								function() use ($recipient, $padded)
								{
									$recipient->datumIs($padded);
								}
							)
						)
					;
				}
			)
			->then
				->object($this->testedInstance->recipientOfDatumOperationWithDatumIs($datum, $recipient))
					->isEqualTo($this->newTestedInstance($length, $padding))
				->mock($recipient)
					->receive('datumIs')
						->withArguments($padded)
							->{4}
		;
	}
}
